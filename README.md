# Paged WP: beautiful PDFs from Wordpress posts and pages

Paged WP is a simple Wordpress plugin that lets you see a print-ready version of your posts and pages, laid out like the pages of a book. You can adapt the default design with your own custom CSS.


## Installation

1. Download the latest packaged version in zip format from the [Releases page](https://github.com/electricbookworks/paged-wp/releases).
2. In your Wordpress admin, go to Plugins > Add New and click 'Upload Plugin'.
3. Click 'Choose File' and find and select the zip file.
4. Click 'Install Now' and then 'Activate'.


## Viewing paged output

To see the paged version of a post or page, open the post or page in the Wordpress admin and click the 'Paged Preview' button. (The button appears in the 'Paged Preview' widget on the right of the editor.) That will open a new preview tab showing the paged version of your post or page.

To save a PDF, press Ctrl+P/Cmd+P in Chrome. **Note that paged output only works properly in Chrome currently.**


## Customising the paged layout

To customise the design of your paged layout, open the plugin settings from Settings > Paged WP or from the Settings link in Plugins > Installed Plugins.

Add your custom CSS to the Custom CSS editor and click 'Save Settings'. If you already have a paged-preview tab open, refresh it to see your changes.

The paged layout depends on Paged Media CSS properties, such as `@page`, and specifically those supported by PagedJS. See the [PagedJS site](https://www.pagedjs.org/) for more details.


## Technical information

The Paged Preview widget button opens a preview of a post or page in a new tab, in which we load only the page content, [paged.js](https://www.pagedmedia.org/paged-js/), and a custom Paged Media CSS file. The default styles were created from the [paged.design](https://paged.design) default template.

This plugin is maintained by [Electric Book Works](https://electricbookworks.com/), and its creation was funded by [Cabbage Tree Labs](https://www.cabbagetreelabs.org/).

Please contribute by logging [issues](https://github.com/electricbookworks/paged-wp/issues) or contributing pull requests. The ongoing maintenance of the plugin is not funded, so we may be slow to reply. For paid support or Paged CSS development, [contact Electric Book Works](https://electricbookworks.com/contact).

## Developer information

To package a version of this plugin for release

1. Install [WP CLI](https://wp-cli.org/) and the [dist-archive](https://developer.wordpress.org/cli/commands/dist-archive/) command
2. Clone this repository to your local development environment 
` git clone git@github.com:electricbookworks/paged-wp.git`
3. In the directory above the paged-wp directory, run the dist-archive command
`wp dist-archive paged-wp`

This will package the plugin with the plugin slug and version number, for redistribution

## Contributors

[Arthur Attwell](https://github.com/arthurattwell), [Jonathan Bossenger](https://github.com/jonathanbossenger), [typometre](https://github.com/typometre)
