# Built with Phalcon

Gallery of applications, demos and projects built with Phalcon

https://builtwith.phalconphp.com

## Disclaimer
This site has been inspired by https://builtwith.angularjs.org/. The github code has been forked and adapted to Phalcon. Credits to the contributors of that project for their hard work.

## Adding your project
If you are familiar with Jekyll, then adding a site will be very easy!

1. Your site needs first a slug. This is the domain name (ignore the `www.`). So if your site is `www.sample.ld` the slug will be `sample.ld`. If your site is `blog.slug.ld` your slug will be `blog.slug.ld`.

2. Fork this repository.

3. Add images:
* Create a folder under `/assets/projects` using your slug (i.e. `/assets/projects/blog.slug.ld`)
* Add the main image for your site. It has to be 500x500 and its name is `thumb.png`. This will be displayed in the front screen.
* Add as many images as you like in that folder (i.e. `frontend.png`, `campaign.png`)

4. Add your page:
* Go to the `_posts` folder. You can copy one of the existing files and adjust its name. The name must be `DATE-slug.md`. The date is in the `Y-m-d` format (i.e. `2018-12-15-blog.slug.ld.md`)

5. Open the file and adjust the metadata in the header. The metadata is enclosed between the `---` lines. Please be careful since errors here will not allow your site to be displayed. The metadata section resembles the `yaml` format

```
---
layout: post                                        // Do not change this
title: 'The Slug Sample site'                       // Add a small title
stub: 'blog.slug.ld'                                // The unique slug
categories: data
meta:
  author:
    name: 'Nikolaos Dimopoulos'                     // Your name (can leave blank)
    avatar: ''                                      // Github avatar or other
    github: 'https://github.com/niden'              // Github profile
    bitbucket: ''                                   // Bitbucket profile
    gitlab: ''                                      // Gitlab profile                                      
  site:
    tags: [ 'single module', 'micro' ]              // Comma separated tags
    link: 'https://blog.slug.ld'                    // Website URL
    social:
      github: 'https://github.com/niden/slug.ld'    // If the source code is available
      facebook: ''                                  // Facebook page/group for the site
      twitter: ''                                   // Twitter account for the site
      discord: ''                                   // Discord channel for the site
images:                                             // If you don't have any images leave the below empty
  - name: 'hmscreen1.png'                           // Name of first image
    text: 'Event Log/Dashboard'                     // Description of first image
  - name: 'hmscreen2.png'                           // Name of second image
    text: 'Campaign Pre-Send Screen'                // Description of second image
---

6. Add the summary/description for your site. You will notice that there is a `<!--more-->` tag in the file you just copied. That placeholder splits the content and whatever is above it will show in the front page, while the rest will show in the page of your project. Please do not allow more than a handful of lines to be displayed at the front page to allow for an easy flow of reading and displaying projects.

7. Issue a pull request
