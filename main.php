<?php

namespace scr\fiso\main

use fiso\Main;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;

class SkyBlock extends PluginCommand {

     /** @var Main $plugin */
     private $plugin;

     const PREFIX = "§l§f[§l§2SKYBLOCK §f]§r ";
     const ADD = "§3Clic me";

     public function __construct(Main $plugin) {
          parent::__construct("sb", $plugin);
          $this->setDescription("§2Skybloc UI");
          $this->plugin = $plugin;
     }

     public function execute(CommandSender $sender, string $commandLabel, array $args) {
          if($sender instanceof Player) {
               $api = $this->plugin->getServer()->getPluginManager()->getPlugin("FormAPI");

               if($api === null || $api->isDisabled()) {
                    return true;
               }

               $form = $api->createSimpleForm(function(Player $sender, $data) {
                    $result = $data;

                    if($result === null) {
                         return;
                    }
                    switch($result) {
                         case 0: // Button 1
                              $this->plugin->getServer()->dispatchCommand($sender, "Your skyblock command");
                         break;
                    }
               });
               $form->setTitle(self::PREFIX);
               $form->setContent("Your content");
               $form->addButton("§2Button 1 \n " . self::ADD);
               $form->sendToPlayer($sender);
          } else {
               $this->plugin->getLogger()->info("You cannot use this command in the console.");
          }
     }
}