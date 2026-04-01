<?php
declare(strict_types=1);
namespace org\CreadoresProgram\BarrelClassicDetect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\Player;
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
    return ($player->getDeviceModel() == "Barrel CREA Classic") && ($player->getDeviceOS() == 7);
  }
  public function getCCPlayers() : array{
    return array_filter($this->getServer()->getOnlinePlayers(), fn($player) => $this->isCCPlayer($player));
  }
  public function onDataPacketSend(DataPacketSendEvent $event) : void {
    $player = $event->getPlayer();
    $packet = $event->getPacket();

    if(!$packet instanceof TextPacket){
        return;
    }
    if($player === null || !$this->isCCPlayer($player)){
        return;
    }
    if($packet->type !== TextPacket::TYPE_TRANSLATION){
        return;
    }
    $event->setCancelled(true);

    $newPacket = new TextPacket();
    $newPacket->type = TextPacket::TYPE_RAW;
    
    $newPacket->message = $this->getServer()->getLanguage()->translateString($packet->message, $packet->parameters);
    
    $player->sendDataPacket($newPacket);
  }
}
