<?php
declare(strict_types=1);
namespace org\CreadoresProgram\BarrelClassicDetect;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
class PocketmineMain extends PluginBase{
  private static ?self $instance = null;
  private static string $deviceModelCC = "Barrel CREA Classic";
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
    return ($player->getDeviceModel() == self::$deviceModelCC) && ($player->getDeviceOS() == 7);
  }
  public function getCCPlayers() : array{
    return array_filter($this->getServer()->getOnlinePlayers(), fn($player) => $this->isCCPlayer($player));
  }
}
