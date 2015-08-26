# Built with Phalcon

Gallery of applications, demos and projects built with Phalcon

## Disclaimer
This site has been inspired by https://builtwith.angularjs.org/.
The github code has been forked and adapted to Phalcon.
Credits to the contributors of that project for their hard work.

## Adding your project
1. Decide on a project permalink. This will be the URL part and it has to be
unique. If someone else has reserved that name, you will need to choose another
one. Example names are: phalconphp-website, phalconphp-forum etc. Please use
only alphanumeric characters and dashes.
2. Fork this repository.
3. Add a 500 by 500px thumbnail image to `public/projects/[yourprojectnamehere]/thumb.png`
4. Add an entry to `app/var/projects.json` with properties (see below)
5. Send a pull request

**Properties example**:

```json
{
    "permalink": "phalconphp-website",
    "name": "Phalcon Website", 
    "summary": "The website of Phalcon, written with Phalcon!", 
    "description": "Phalcon is a web framework...",
    "url": "http://www.phalconphp.com",
    "info": "", 
    "src": "https://github.com/phalcon/website", 
    "submitter": "niden",
    "submissionDate": "2014-01-05",
    "images": [], 
    "tags": []
}
```

**Properties**:

| Name             | Description                                                   |
| ---------------- | ------------------------------------------------------------- |
| `permalink`      | This is your project link (appears on the URL)                |
| `name`           | will be displayed above the screenshot                        |
| `summary`        | A short summary of the project                                |
| `description`    | A lengthy description of the project                          |
| `url`            | The project URL                                               |
| `info`           | Additional information for the project (blog etc.)            |
| `src`            | Url to source repository (optional)                           |
| `submitter`      | Github username                                               |
| `submissionDate` | Current date in ISO format                                    |
| `images`         | Names of images placed in `public/projects/[yourprojectname]` |
| `tags`           | See bellow                                                    |

**Tags**:

| Name                                    | Description                               |
| --------------------------------------- | ----------------------------------------- |
| `demo`, `production`, `toy`             | choose your app seriousness level         |
| `CRUD`, `entertainment`, `productivity` | choose your app type                      |
| `mysql`, `mongo`, `postgres`            | database access                           |
| `open source`                           | tag open source projects                  |
| `single`, `multi module`, `micro`       | type of project                           |
| `github`, `bitbucket`                   | use if open source                        |
| `tests included`                        | use if open source and tests are included |
