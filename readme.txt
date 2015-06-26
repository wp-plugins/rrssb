=== RRSSB ===
Contributors: whack47
Donate Link: http://aklosismedia.com/quotes/dev
Tags: social, share, buttons, addthis, facebook, email, googleplus, google, youtube, reddit, twitter, github, tumblr, hackernews, linkedin, pinterest, pocket, responsive, rrssb, ridiculously, sharing, likes
Requires at least: 3.8
Tested up to: 4.2
Stable tag: trunk
License: GPLv2 or later

Create social sharing buttons using the ridiculously responsive social sharing buttons script.

== Description ==
RRSSB stands for ridiculously responsive social share buttons and is an adaptation of Kurt Noble's library for web. Install the plugin and use the exposed function or shortcode to display social sharing buttons on your site.

rrssb(options);

Function options can be a string (comma separated for multiple values)
or an array of strings

[rrssb options=""]

Shortcode options can be a string (comma separated for multiple values)

== Installation ==
Download or find in WordPress library. Install and activate. To make buttons appear, use the shortcode in one of your posts or pages. Alternatively use the exposed function rrsb(options); in any template file.
`
[rrssb options="<a comma separated list of social buttons>"]
`

For example:
`
[rrssb options="email, facebook, twitter, googleplus, linkedin, reddit, youtube, pinterest, pocket, github, tumblr, hackernews"]
`

Or use the exposed function rrssb(options); in any of your templates.
`
<?php
if (function_exists('rrssb')) {
    rrssb(array(
        'facebook',
        'twitter',
        'googleplus'
    ));
}
?>
`
A single comma separated string will work too!
`
<?php
if (function_exists('rrssb')) {
    rrssb('facebook, twitter, googleplus');
}
?>
`

Use the option 'outside_loop' if you want to add buttons to your header or to an archive page.

== Frequently Asked Questions ==

= Why aren't the buttons showing up? =

Did you add the shortcode or function? Make sure you are correctly passing the options in according to the examples in the installation section.

= Why aren't images or descriptions being populated in the share screens? =

A few notes about this:
If you are working on a local development site, the pictures won't show up and the Twitter character count will be off.
In a hosted environment, images will get pulled from the Facebook or Twitter metatags (you must include these yourself).
If the metatags are not available, images will be taken from the article in which the buttons are found.
If the description metatag is not available, it will be copied from your site's tagline in WordPress's settings.

== Screenshots ==

1. Look how cool it is.

== Changelog ==

initial release

== Upgrade Notice ==

none
