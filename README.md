TwiWordsCloud
======================

On the front page you can enter search keyword. Using Twitter API script will get 300 
recent twits in english and will show the most popular words in cloud. The more times it appears 
in twits the bigger font-size it has. 
In the footer you can find how much queries left due to Twitter API limits.

PHP: Composer, Yii Framework, PHPUnit.
JavaScript: Bower, Jquery, wordcloud2.js plugin.
Storage: SQLite3.

You can try with internal PHP sever. Run `sudo php -S 127.0.0.1` from the root directory and point your browser to 'http://127.0.0.1/'.

![Demo](https://raw.githubusercontent.com/yegortokmakov/sample1/master/dr1.png "Demo screenshot for keyword 'Ukraine'")


INSTALL
------------
+ Clone this repo to your local directory.
+ Create file `protected/config/constants.php` (example: constants.php.template) and fill in TWITTER_API_KEY and TWITTER_API_SECRET constants.
+ From the project root directory run `./protected/init`. This command installs dependencies, initializes database with migrations and runs unit tests.

REQUIRED
------------
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
+ Input data validation
+ Security: directory structure
