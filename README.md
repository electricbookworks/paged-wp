# Paged WP: beautiful PDFs from Wordpress posts and pages

Paged WP is a very simple, proof-of-concept Wordpress plugin that adds a button to the admin view of Wordpress pages/posts.

Clicking that button opens a preview of the post in a new tab, in which we load only the page content, [paged.js](https://www.pagedmedia.org/paged-js/), and a custom Paged Media CSS file, so that you can get a rendered paged view and save it to PDF.

## Usage

There is a lot still to improve here. For now:

- Paged.js only works properly in Chrome, so you should use Chrome for this, too. 
- You must hard-code the link to your Paged Media CSS in the paged-wp.php file. By default, it loads the template styles from [paged.design](https://paged.design).
- This fork work with the Classic or Gutenberg editor.

## Roadmap

We'd like to make it easier to link to and/or add custom CSS, and to clean up the code to be more function-oriented and less procedural. That will depend on our finding time and funding to continue work on it.
