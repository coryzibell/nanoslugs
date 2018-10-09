# Nanoslugs for Craft CMS 3.x

Nanoslugs is a Craft plugin that sets the slug of a new entry to be a [nanoid](https://github.com/ai/nanoid).

This plugin copies heavily from Madhouses's [Slugger](https://github.com/madmadmad/slugger) plugin that does something very similar using a different library. Thanks, Madhouse. :smiley:
Their plugin copies heavily from Alec Ritson's [Slugged](https://github.com/alecritson) plugin for Craft 2. Thanks, Alec. :smiley: (The section override works in this version btw.)

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

Visit the Plugin Store in your Craft 3 control panel and install from there. Nanoslugs costs nothing.
Visit the Plugin Store in your Craft 3 control panel. It costs nothing.

Or...

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require coryzibell/nanoslugs

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Nanoslugs.


## Configuration
All configuration is done in the plugin settings page in the admin area.

### Plugin settings

***Default length***
The length of the hash, this will be overwritten with any length defined for a section

Default: `8`

***Alphabet***
The characters to use when generating the slug.

Default: `0123456789abcdefghijklmnopqrstuvwxyz-`

***Sections***
The only sections that will be listed are editable sections (no singles obvs). If you add a length to a section this will override the default set above. A section must be enabled for the hashing to happen, regardless of whether you add a length override or not.

## Using Nanoslugs
Enable your section in the settings. Make a new entry. Save it. Voila... cryptographically secure slug.

## Support, issues, feedback

If you experience any problems please create a new issue here on the repo.
