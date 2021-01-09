# Super RSS Reader - Add attractive RSS Feed Widget
Contributors: vaakash
Author URI: https://www.aakashweb.com/
Plugin URI: https://www.aakashweb.com/wordpress-plugins/super-rss-reader/
Tags: rss, widget, ticker, feed, news, twitter, admin, plugin, posts, page, thumbnail, atom, shortcode
License: GPLv2 or later
Donate Link: https://www.paypal.me/vaakash
Requires at least: 2.8
Requires PHP: 5.3
Tested up to: 5.5.1
Stable tag: 4.0

Display any RSS feed(s) in widget with news ticker effect in multiple tabs, thumbnails, customizable color themes and more.

## Description

Super RSS Reader plugin allows you to display RSS feed(s) in an attractive way to your widget. It has options to display multiple RSS feeds separated by tabs in a single widget and has feature to add a news ticker like effect to it. See the features list below for complete list.

The widget is fully customizable with external styles and also has color themes out of the box. It is a perfect replacement for the default RSS widget in WordPress.

[Check out the **LIVE DEMO** of the plugin](https://www.aakashweb.com/demos/super-rss-reader/)

### ✨ Features

* **News ticker** - Add news ticker like effect to the RSS feeds (can turn on of off)
* **Multiple tabs** - Display multiple feeds in one widget separated by tabs.
* **Thumbnail** - Display the thumbnail of the feed item.
* **Color themes** - Options of multiple color themes out of the box. Customizable via CSS.
* Different **thumbnail positions** (align left, right and cover)
* Customizable ticker speed.
* Supports RSS and atom feed.
* Trim title and description text of the feed item.

### 🌄 Display RSS feeds like

* Your own website content like recent posts, comments, forum topics etc.
* Articles, posts from related websites and share with your users.
* Events, job listings etc. from other websites.
* Deals, Craigslist etc. You got it, any RSS feed on your site !

[youtube=https://www.youtube.com/watch?v=02aOG_-98Tg]

### 💎 PRO version

Super RSS reader has a PRO version which has more features to further enhance and to get more control of the RSS feed you display. With the PRO version you can enjoy below additional features included and also support the development of this plugin.

* **Shortcode** - Display RSS feed anywhere in your website using `[srr_feed]`
* **Grid display** - Display feed item in rows and columns
* **Custom feed item template** - Change order of feed item content, add HTML
* **4 new** color themes

[**More information**](https://www.aakashweb.com/wordpress-plugins/super-rss-reader-pro/?utm_source=readme&utm_medium=description&utm_campaign=srr-pro) - [Live demo](https://wpdemos.aakashweb.com/super-rss-reader-pro/?utm_source=readme&utm_medium=description&utm_campaign=srr-pro)

### Resources

* [FAQs](https://www.aakashweb.com/docs/super-rss-reader/faq/)
* [Documentation](https://www.aakashweb.com/docs/super-rss-reader/)
* [Support forum](https://www.aakashweb.com/forum/discuss/wordpress-plugins/super-rss-reader/)

## Installation

Download and upload the latest version of Super RSS Reader,

1. Unzip & upload it to your WordPress site.
1. Activate the plugin.
1. Drag and drop the "Super RSS Reader" widget in the "Widgets" page.
1. Input a RSS feed URL to the widget, tweak some settings and you are,
1. Done !

## Frequently Asked Questions

### My RSS feed is not refreshing !

By default WordPress caches the RSS feed for 12 hours. You can change this default value by adding the below code to your theme's function.php file.

`add_filter( 'wp_feed_cache_transient_lifetime', function($a) { return 600; } );`

Here 600 indicates 10 minutes in seconds. Please note that setting lower value will increase the load on the server to refresh the RSS cache.

You can also refer this post https://wordpress.org/support/topic/rss-not-updating-no-matter-which-plugin-i-try/#post-10123881 to change the refresh time for particular feed URL.

Also, please ensure WordPress cache plugins (like W3 total cache, Super cache etc.) are configured to not cache the page where this widget is active or increase the expiry of the cache so that old cached page is not served to the users.

### How can I customize the RSS widget via CSS styles ?

There is a list of CSS classes which are available to take control and customize the RSS feed to the design as intended. The complete list of CSS classes can be found in [this page](https://www.aakashweb.com/docs/super-rss-reader/faq/)

### RSS feed is not displayed or error is shown

This can happen when,

* The RSS feed URL is invalid.
* The feed URL is not accessible by the server.
* The feed content is not in the expected format or corrupt. Please use a [feed validation service](https://validator.w3.org/feed/) to validate the feed.

### Does this plugin support horizontal ticker ?

No, Super RSS Reader only supports vertical support feature for now.

### How to display the feeds in multiple tabs ?

Enter the RSS feed URLs separated by comma or in new line in the widget, the plugin automatically renders the tab.

### What are the contents shown in the feed ?

By default content like title, date, author, description, thumbnail can toggled to show in the feed.

### Can I change the order of the content shown in the feed ?

Yes, it is possible with the [PRO version](https://www.aakashweb.com/wordpress-plugins/super-rss-reader-pro/?utm_source=readme&utm_medium=faq&utm_campaign=srr-pro) of the plugin. In the free version we can toggle the content.

### Will the additional ticker effect slow down the site ?

The additional effect needs only 2.5 KB of additional JavaScript file which is very small since it is minified and optimized already.

[More FAQs in this page](https://www.aakashweb.com/docs/super-rss-reader/faq/)

## Screenshots

1. Super RSS Reader widgets shown in the sidebar, having a ticker effect and in tabbed mode.
1. RSS feed widget in different themes and for different feed URLs.
1. Some more examples of the RSS feed.
1. Widget options.

[Live working demo](https://www.aakashweb.com/demos/super-rss-reader/)

## Changelog

### 4.0
* New: Reliable thumbnails. Thumbnails will now be taken from multiple places like feed content.
* New: Thumbnail positions (align left, right and cover mode) and size can be changed.
* New: Widget options are now more refined, easy to find and use.
* New: Plugin is now translation ready.
* New: `noreferrer` added to the feed links.
* New: Stripe of feed items is now done using CSS class `srr-stripe` instead of `even`.
* New: Introducing [PRO version](https://www.aakashweb.com/wordpress-plugins/super-rss-reader-pro/?utm_source=readme&utm_medium=changelog&utm_campaign=srr-pro).

### 3.2
* Fix: Read more link not present
* New: Widgets settings is now clean and easy to use.
* New: Thumbnail and description can now be displayed separately.
* New: Description and title text are now trimmed by "words" instead of "characters".
* New: `Enable ticker` option is now replaced with `Display type`.
* Fix: Refactor code.
* Fix: Undefined index notice upon saving the widget.

### 3.1
* Fix: Settings not being saved.
* New: Updated the ticker library to the latest.
* Fix: Added cache buster to JS and CSS files.
* Fix: Upon tab change, sometimes ticker height gets to 0;

### 3.0
* New: Plugin code is refactored.
* New: Options are reorganized for easy configuration.
* Fix: Minor UI changes.
* Fix: Certain PHP notices on saving widget settings.

### 2.8
* New: jQuery ticker script is now loaded locally.
* Fix: Minor style adjustments to the admin widget.

### 2.7
* New: Support for "no follow" attribute in links.
* Fix: Readme with updated FAQ.

### 2.6
* New: Ability to set fixed height for the RSS widget.
* New: Using minified JavaScript on frontend.
* Fix: Cleaned widget UI, reordered options.
* Fix: Code refactoring.

### 2.5
* Added feature to change individual tab titles/names.
* Added feature to enable rich or full description.
* Fixed feed ordering issues.
* Updated jQuery easy ticker plugin to v2.0.
* Minor code revisions.

### 2.4
* Added feature to cut down/strip feed titles.
* Added a new 'Simple modern' color style.

### 2.3
* Fixed incompatibility of other jQuery plugins due to the usage of the latest version of jQuery.

### 2.2
* Displays "thumbnail" of the feed item if available.
* Added setting to change ticker speed.
* Added setting to edit the "Read more" text.
* Default styles are revised.
* Switched to full size ticker code.
* Core code revised.

### 2.1
* Added option to open links in new window.
* Changed the method to include the scripts and styles.
* Added a new 'Orange' color style.

### 2.0
* Core code is completely rewritten.
* Flash RSS Reader is removed and instead jQuery is used.
* Administration panel used in the previous version is removed and settings are configured in the widget itself.

### 0.8
* Second version with included CSS and Proxy file (loadXML.php).

### 0.5
* Initial version with a flash RSS Reader

## Upgrade Notice

Version 2.0 is a major and recommended upgrade for previous version users.