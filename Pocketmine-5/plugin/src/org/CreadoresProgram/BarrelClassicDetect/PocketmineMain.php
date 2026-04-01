<?php
declare(strict_types=1);
namespace org\CreadoresProgram\BarrelClassicDetect;
use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
class PocketmineMain extends PluginBase{
  private static ?self $instance = null;
  public static function getInstance() : ?self{
    return self::$instance;
  }
  public function onEnable() : void{
    $this->getLogger()->info("§aDone!");
  }
  public function onDisable() : void{
    $this->getLogger()->info("§cBye!");
  }
  public function isCCPlayer(Player $player) : bool{
    $extraData = $player->getNetworkSession()->getPlayerInfo()->getExtraData();
    $deviceModel = $extraData["DeviceModel"] ?? "";
    $osId = $extraData["DeviceOS"] ?? -1;
    return ($deviceModel == "Barrel CREA Classic") && ($osId == 7);
  }
  public function getCCPlayers() : array{
    return array_filter($this->getServer()->getOnlinePlayers(), fn($player) => $this->isCCPlayer($player));
  }
  public function onDataPacketSend(DataPacketSendEvent $event) : void {
    $packets = $event->getPackets();
    
    foreach($packets as $packet){
        if($packet instanceof TextPacket){
            if($packet->type !== TextPacketType::TRANSLATION){
                continue;
            }
            foreach($event->getTargets() as $target){
                $player = $target->getPlayer();
                if($player instanceof Player && $this->isCCPlayer($player)){
                    
                    $event->setCancelled();

                    $newPacket = TextPacket::raw(
                        $this->getServer()->getLanguage()->translateString($packet->message, $packet->parameters)
                    );
                    
                    $target->sendDataPacket($newPacket);
                }
            }
        }
    }
  }
}
