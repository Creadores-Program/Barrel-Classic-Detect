package org.CreadoresProgram.BarrelClassicDetect;
import cn.nukkit.Player;
import cn.nukkit.event.Listener;
import cn.nukkit.event.server.DataPacketSendEvent;
import cn.nukkit.event.EventHandler;
import cn.nukkit.network.protocol.TextPacket;
import cn.nukkit.plugin.PluginBase;
import java.util.List;
import java.util.ArrayList;
import java.util.stream.Collectors;
public class NukkitMain extends PluginBase implements Listener{
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
  @EventHandler
  public void onDataPacketSendEvent(DataPacketSendEvent event){
    Player player = event.getPlayer();
    if(getServer().isLanguageForced() || player == null || !(event.getPacket() instanceof TextPacket) || !this.isCCPlayer(player) || event.isCancelled()){
      return;
    }
    TextPacket packet = (TextPacket) event.getPacket();
    if(packet.type != TextPacket.TYPE_TRANSLATION){
      return;
    }
    event.setCancelled(true);
    TextPacket pk = new TextPacket();
    pk.type = TextPacket.TYPE_RAW;
    pk.message = getServer().getLanguage().translateString(packet.message, packet.parameters);
    player.dataPacket(pk);
  }
}
