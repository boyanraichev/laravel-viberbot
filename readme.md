# Viber Bot

The purpose of this package is to allow the use of the Viber Bot option for transactional communication with your customers, unlike other packages that are geared for advertising broadcast or answering support questions. 

This package is based on *paragraf-lex/viber-bot*.

# Installation

Install through Composer.

# Setup

## Env

Set the following parameters in your .env file:

`
VIBERBOT_API=viber_token
VIBERBOT_NAME=name
VIBERBOT_PHOTO=photo
VIBERBOT_LOG=true
VIBERBOT_SEND=true
`

## Config

Additional configuration is available through the config file. You can publish it to your config folder:

`php artisan vendor:publish --tag=viberBot`

## Webhook

To publish your webhook setup your route and run the following artisan command with the route name as argument:

`php artisan viberbot:webhook route_name`

## Logging

Use the env/config parameter to turn on or off the logging of incoming hook calls and outgoing viber messages. Useful for debugging or saving a history of conversations.

*You need to setup two logging channels called `viberbot` and `viberbot_hook` if you activate logging.*

# Subscribing a user

Use the Bot to listen to ConversationStarted events, so you can send a message to the customer, prompting a subscription to your bot. Make sure you save the viber ID that you receive upon subscription!

You can also build your Bot to answer questions, if you need to.

# Sending a message

Use the Client to send messages to your subscribers and build your notifications!

1. Create a message that extends one of the ViberMessage classes from the package, i.e. `Boyo\Viberbot\Messages\TextMessage`
2. Set the `$this->text` parameter (for a text message), and any other needed parameter (keyboards, media, etc.), within the Message class construct
3. Create an instance of the Client `$client = new ViberClient();`
4. Send the message, passing a ViberUser model (the recipient) `$client->send($message,$user)`

# Builiding a notification

1. Add the viberbot channel to the via parameter in your Laravel notification `$via[] = ViberbotChannel::class;`
2. Create a method `toViberbot($notifiable)`
3. In this method return a Viber Message which extends one of the classes from the package, i.e. `Boyo\Viberbot\Messages\TextMessage`
4. Set the `$this->text` parameter (for a text message), and any other needed parameter (keyboards, media, etc.), within the Message class construct