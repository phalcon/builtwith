<a name="submit"></a>
# builtwith.phalconphp.com

Gallery of applications, demos and projects built with Phalcon

Disclaimer
----------
This site has been inspired by https://builtwith.angularjs.org/. The github code has been forked and adapted to Phalcon. Credits to the contributors of that project for their hard work.

Adding your project
----------------------
1.  Decide on a project permalink. This will be the URL part and it has to be
unique. If someone else has reserved that name, you will need to choose another
one. Example names are: phalconphp-website, phalconphp-forum etc. Please use
only alphanumeric characters and dashes.
2.  Fork this repository.
3.  Add a 500 by 500px thumbnail image to `public/projects/[yourprojectnamehere]/thumb.png`
4.  Add an entry to `app/var/projects.json` with these properties:

```json
{
	"permalink": "phalconphp-website",  // This is your project link (appears on the URL)
	"name": "Phalcon Website",       // will be displayed above the screenshot
	"summary": "The website of Phalcon, written with Phalcon!", // A short summary of the project
	"description": "Phalcon is a web framework...", // A lengthy description of the project
	"url": "http://www.phalconphp.com", // The project URL
	"info": "",                         // Additional information for the project (blog etc.)
	"src": "https://github.com/phalcon/website",    // Url to source repository (optional)
	"submitter": "niden",               // Github username
	"submissionDate": "2014-01-05",     // Current date in ISO format
	"images": [],                       // Names of images placed in public/projects/[yourprojectname]
	"tags": [
		"demo", "production", "toy"                 // choose your app seriousness level
		"CRUD", "entertainment", "productivity",    // choose your app type
		"mysql", "mongo", "postgres",               // database access
		"single", "multi module", "micro"           // type of project
		"open source",                              // tag open source projects
		"github", "bitbucket",                      // use if open source
		"tests included"                            // use if open source and tests are included
	]
	... // others?
}
```
        
5.  Send a pull request
