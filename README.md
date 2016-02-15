# requirements
you must add the following to your composer.json file in order for this plugin to work

``` javascript

    "autoload": {
		"files": [
			"public/content/plugins/amazon-web-services/classes/aws-plugin-base.php",
			"public/content/plugins/amazon-s3-and-cloudfront/classes/amazon-s3-and-cloudfront.php"
		]
	},

```