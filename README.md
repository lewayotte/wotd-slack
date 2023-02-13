# Merriam Webster WOTD Slack Integration

A custom slack integration to send the Merriam Webster Word of the Day to a Slack Channel.

## Setting Up Slack

1. Go to [your apps](https://api.slack.com/apps/) and create a new app from scratch
   App Name: Word of the Day (or whatever you choose)
   Pick a workspace to develop your app in: Whatever slack organization this app should work
2. Scroll down to Display Information
   App Name: Word of the Day
   Short Description: Merriam-Webster's Word of the Day
   + Add App Icon (`mw.png` in this repo is a good one)
   Background Color: #2d5f7c
   Save Changes
3. oAuth & Permissions: Bot Token Scope: chat:write
4. Install to WordSpace > Allow
5. Copy your Bot User OAuth Token and add it to your `.env` in the `SLACK_TOKEN` variable and set the `SLACK_CHANNEL` variable to the channel you want to which you wish to post the Word of the Day
6. Invite your bot to the channel you want it to post to
7. Hopefully everything works.

## Requirements

1. Tested up to PHP8.2
2. [Composer](https://getcomposer.org)

## Installation

1. `git clone git@github.com:lewayotte/wotd-slack.git`
2. `cd wotd-slack/`
3. `composer install`
4. `cp .env.example .env`
5. Edit .env and add your SLACK_TOKEN and SLACK_CHANNEL
6. Setup a cronjob, similar to this (this runs every day at 9:15AM):
`15 9 * * * /usr/bin/php /path/to/your/slack-wotd/wotd.php > /dev/null 2>&1`
7. Learn new words
