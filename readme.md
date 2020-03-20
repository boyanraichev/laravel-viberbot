# Viber Bot

The purpose of this package is to allow the use of the Viber Bot option for transactional communication with your customers, unlike other packages that are geared for advertising broadcast or answering support questions. 

This package is a fork of *paragraf-lex/viber-bot*.

# Installation

Install through Composer.

# Setup

## Env

Set the following parameters in your .env file:

`
VIBERBOT_API=viber_token
VIBERBOT_NAME=name
VIBERBOT_PHOTO=photo
`

## Config

Additional configuration is available through the config file. You can publish it to your config folder:

`php artisan vendor:publish --tag=viberBot`

## Webhook

To publish your webhook setup your route and run the following artisan command with the route name as argument:

`php artisan viberbot:webhook route_name`

# Subscribing a user

Use the Bot to listen to ConversationStarted events, so you can send a message to the customer, prompting a subscription to your bot. Make sure you save the viber ID that you receive upon subscription!

You can also build your Bot to answer questions, if you need to.

# Sending a message

Use the Client to send messages to your subscribers and build your notifications!