# BarrelClassicDetect
Detects when a ClassiCube player joins your server!


Compatible with Nukkit and Pocketmine ([MySoft](https://github.com/Dr1xyDev/MySoft-0.15.x-1.21.x), [Submarine](https://github.com/Dr1xyDev/SubmarineMultiCore), [Pocketmine 5 MV](https://github.com/vapebw/Pocketmine-5-MV))!

## Installation (Nukkit)
Simply place the plugin in the plugins folder!
### API usage
Implement in your project:
Maven:
Place the plugin's jar file in the libs folder and run this command:
```bash
mvn install:install-file -Dfile=libs/Barrel-Classic-Detect-x.x.x.jar -DgroupId=org.CreadoresProgram -DartifactId=Barrel-Classic-Detect -Dversion=x.x.x -Dpackaging=jar -DgeneratePom=true # replace x.x.x with the plugin version
```
pom.xml:
```xml
<dependency>
  <groupId>org.CreadoresProgram</groupId>
  <artifactId>Barrel-Classic-Detect</artifactId>
  <version>x.x.x</version><!--replace x.x.x with the plugin version-->
  <scope>provided</scope>
</dependency>
```
plugin.yml:
```yaml
#...
softdepend:
  - "Barrel_Classic_Detect"
loadbefore:
  - "Barrel_Classic_Detect"
```
example of use:
```java
//import the class into your plugin
import org.CreadoresProgram.BarrelClassicDetect.NukkitMain;
//...
//is ClassiCube Player?
NukkitMain.getInstance().isCCPlayer(player);//player = cn.nukkit.Player returns boolean

//get all ClassiCube Players
NukkitMain.getInstance().getCCPlayers(); //returns List<cn.nukkit.Player>
```

## Installation (Pocketmine)
Simply place the plugin in the plugins folder!
### API usage
Implement in your plugin:

plugin.yml:
```yaml
#...
softdepend: ["Barrel_Classic_Detect"]
```

example of use:
```php
<?php
declare(strict_types=1);
//...
//Use the class in your plugin.
use org\CreadoresProgram\BarrelClassicDetect\PocketmineMain;
//...
//is ClassiCube Player?
PocketmineMain::getInstance()->isCCPlayer(player);//player = pocketmine\player\Player or pocketmine\Player returns bool
//get all ClassiCube Players
PocketmineMain::getInstance()->getCCPlayers(); //returns pocketmine\player\Player[] or pocketmine\Player[] array
```
