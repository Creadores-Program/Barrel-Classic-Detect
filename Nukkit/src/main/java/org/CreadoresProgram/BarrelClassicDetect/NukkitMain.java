package org.CreadoresProgram.BarrelClassicDetect;
import cn.nukkit.Player;
import cn.nukkit.plugin.PluginBase;
import java.util.List;
import java.util.ArrayList;
import java.util.stream.Collectors;
public class NukkitMain extends PluginBase{
  private static NukkitMain instance;
  public static NukkitMain getInstance(){
    return instance;
  }
  public void onEnable(){
    instance = this;
    this.getLogger().info("§aDone!");
  }
  public void onDisable(){
    this.getLogger().info("§cBye!");
  }
  public boolean isCCPlayer(Player player){
    return player.getLoginChainData().getDeviceModel().equals("Barrel CREA Classic") && player.getLoginChainData().getDeviceOS() == 7;
  }
  public List<Player> getCCPlayers(){
    return this.getServer().getOnlinePlayers().values().stream().filter(player -> isCCPlayer(player)).collect(Collectors.toList());
  }
}
