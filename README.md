<h1>DiscordWebhookAPI<img src="https://raw.githubusercontent.com/CortexPE/DiscordWebhookAPI/master/dwapi.png" height="64" width="64" align="left"></img>&nbsp;<img src="https://poggit.pmmp.io/ci.shield/CortexPE/DiscordWebhookAPI/~"></img></h1>
<br />

A PocketMine-MP Virion to easily send messages via Discord Webhooks

# Usage:
Installation is easy, you may get a compiled phar [here](https://poggit.pmmp.io/ci/CortexPE/DiscordWebhookAPI/~) or integrate the virion itself into your plugin.

This virion is purely object oriented. So, to use it you'll have to import the `Webhook` object, the `Message` object and the optional `Embed` object (if necessary)

## Basic Usage:
### Import the classes
You'll need to import these classes in order to easily use it within our code.
```php
<?php

use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;
use CortexPE\DiscordWebhookAPI\Embed; // optional
```
### Construct a Discord `Webhook` object
You'll need the Webhook's URL. For more information regarding how to create Discord webhooks on a Discord Text Channel, Please [click here](https://support.discordapp.com/hc/en-us/articles/228383668-Intro-to-Webhooks).
```php
$webHook = new Webhook("YOUR WEBHOOK URL");
```
### Construct a Discord `Message` object
You'll need to create a new `Message` object for every message that you want to send... You can use different message objects for separate webhooks and this object **DOES NOT** depend on the `Webhook` object. It is stand-alone and it would work by itself.
```php
$msg = new Message();
$msg->setUsername("USERNAME"); // optional
$msg->setAvatarURL("https://cortexpe.xyz/utils/kitsu.png"); // optional
$msg->setContent("INSERT TEXT HERE"); // optional. Maximum length is 2000 characters, the limit is set by discord, therefore it is not hardcoded within this API
```
### Sending the message
You can easily send the message to the webhook now! :tada: This will schedule a new AsyncTask on the Server's AsyncPool to prevent blocking the Main Thread. Do take note however, that **you CANNOT send a blank message.** doing so will only produce an error received from Discord itself.
```php
$webHook->send($msg);
```
How easy was that? ^-^ Now for the much more advanced and cooler stuff, Embeds!
### Embeds
Before you send the message, you might want to add an embed. A message can have several embeds in it! You only have to construct an embed and use the `Message->addEmbed()` method to add it into the message object.
```php
$embed = new Embed();
```
Now, the embed has to have something in it to function properly, so we'll add in a title (optional) and a description (optional). **All of the fields are optional, but it should contain ATLEAST one field or it would refuse to add it into the message**
```php
$embed->setTitle("Embed Title Here");
$embed->setDescription("A very awesome description");
```
We can even set a footer text! The text on the bottom part of the embeds...
```php
$embed->setFooter("Erin is kawaii UwU");
```
Or even, add an icon to the footer...
```php
$embed->setFooter("Erin is kawaii UwU","https://cortexpe.xyz/utils/kitsu.png");
```
Now that the embed has been constructed and has a valid content, we will have to add it to the `Message` object... We'll need to use the `Message->addEmbed()` method for that.
```php
$msg->addEmbed($embed);
```
**That's all for the Basic Usage of the API. To learn more, You can explore it by reading the API's source code yourself (the code is simple and explanatory) or by using your favorite IDE to index it yourself. :3**
# Sample Code used to test this API earlier:
```php
// Construct a discord webhook with its URL
$webHook = new Webhook("YOUR WEBHOOK URL");

// Construct a new Message object
$msg = new Message();

$msg->setUsername("USERNAME");
$msg->setAvatarURL("https://cortexpe.xyz/utils/kitsu.png");
$msg->setContent("INSERT TEXT HERE");

// Create an embed object with #FF0000 (RED) as the embed's color and "EMBED 1" as the title
$embed = new Embed();
$embed->setTitle("EMBED 1");
$embed->setColor(0xFF0000);
$msg->addEmbed($embed);

$embed = new Embed();
$embed->setTitle("EMBED 2");
$embed->setColor(0x00FF00);
$embed->setAuthor("AUTHOR", "https://CortexPE.xyz", "https://cortexpe.xyz/utils/kitsu.png");
$embed->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
$msg->addEmbed($embed);

$embed = new Embed();
$embed->setTitle("EMBED 3");
$embed->setColor(0x0000FF);
$embed->addField("FIELD ONE", "Some text here");
$embed->addField("FIELD TWO", "Some text here", true);
$embed->addField("FIELD THREE", "Some text here", true);
$embed->setThumbnail("https://cortexpe.xyz/utils/kitsu.png");
$embed->setImage("https://cortexpe.xyz/utils/kitsu.png");
$embed->setFooter("Erin is kawaii UwU","https://cortexpe.xyz/utils/kitsu.png");
$msg->addEmbed($embed);

$webHook->send($msg);
```
-----
**This API was made with :heart: by CortexPE, Enjoy!~ :3**
