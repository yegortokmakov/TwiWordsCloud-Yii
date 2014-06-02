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

![Demo](https://raw.githubusercontent.com/yegortokmakov/sample1/master/dr1.png "Demo screenshot for keyword 'Ukraine'")


INSTALL
------------

+ Clone this repo
+ Register Twiitter API (https://dev.twitter.com/docs/api/1.1) application.
+ Create file `protected/config/constants.php` (example: constants.php.template) and fill in TWITTER_API_KEY and TWITTER_API_SECRET constants.
+ From the project root directory run `./protected/init`.


TODO
------------

+ Tranding graph of mentions per day/hour.
+ Count TF-IDF
+ Unit tests
+ Input data validation
+ Console command example
+ Security: directory structure
