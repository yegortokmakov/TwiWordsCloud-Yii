Sample project 1
======================

This is a sample project intended to show use of some technologies.

On the front page you can enter search keyword. Using Twitter API script will get 300 
recent twits in english and will show the most popular words in cloud. The more times it appears 
in twits the bigger font-size it has. 
In the footer you can find how much queries left due to Twitter API limits.

PHP: Composer, Yii Framework (with custom extension, component, helper, migration).
JavaScript: Bower, Jquery, wordcloud2.js plugin.
Storage: SQLite3.

You can test code with internal PHP sever. Just run `sudo php -S 127.0.0.1` from the root directory and point your browser to 'http://127.0.0.1/'.

![Demo](https://github.com/yegortokmakov/sample1/master/dr1.png "Demo screenshot for keyword 'Ukraine'")


INSTALL
------------

+ You will need Twiitter API (https://dev.twitter.com/docs/api/1.1) account set up. Fill in `api_key` and `api_secret` variables in `protected/config/main.php`.
+ To update database scheme from the project root directory run `./protected/yiic migrate up`.
+ To update PHP dependencies. Install Composer (https://getcomposer.org/) and run `composer update`.
+ To update JavaScript dependencies. Install Bower (http://bower.io/) and run `bower update`.


TODO
------------

+ Tranding graph of mentions per day/hour.
+ Count TF-IDF
+ Unit tests
+ Input data validation
+ Console command example
+ Security: directory structure
