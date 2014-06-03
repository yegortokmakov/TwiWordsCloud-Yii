TwiWordsCloud
======================

This small project builds words cloud based on user provided keyword. Twitter API client consumes 300 
recent tweets and shows only the most popular words from them. The more times word appears 
in tweets the bigger font size it has. As Twitter API has some limit for developers, you can find how 
much queries left at the bottom of the page footer.

**PHP**: Composer, Yii Framework, PHPUnit.
**JavaScript**: Bower, Jquery, wordcloud2.js plugin.
**Storage**: SQLite3.

You can try with internal PHP sever (PHP >=5.4). Run `sudo php -S 127.0.0.1` from the public_html directory and point your browser to http://127.0.0.1/.

![Demo](https://raw.githubusercontent.com/yegortokmakov/sample1/master/screenshot1.png "Demo screenshot for keyword 'Ukraine'")

If you are going to use this code, please check licenses for project dependency libraries. 

INSTALLATION
------------
+ Clone this repo to your local directory.
+ Create file `protected/config/constants.php` (example: constants.php.template) and fill in TWITTER_API_KEY and TWITTER_API_SECRET constants.
+ From the project root directory run `./protected/init`. This command installs dependencies, initializes database with migrations and runs unit tests. Be sure it doesn't show errors.

REQUIREMENTS
------------
+ PHP >= 5.4: http://php.net
+ Composer: https://getcomposer.org/
+ Bower: http://bower.io/
+ SQLite3: http://www.sqlite.org/
+ Twiitter API application: https://apps.twitter.com/

CONSOLE
------------
You can view cached Twitter API responses with `./protected/yiic cache` shell command.

You can delete cached responses with `./protected/yiic cache delete --num=<Entry #>` command.

TODO
------------
+ Use RequireJS / Grunt.
+ Deploy to Amazon AWS.
