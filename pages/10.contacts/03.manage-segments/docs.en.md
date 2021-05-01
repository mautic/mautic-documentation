---
title: 'Manage segments'
media_order: 'contact-segments.jpg,segment-filters.jpg,multiple-segment-filters.jpg,segment-filters-dropdown.jpg,common-leads-in-segments.jpg,segment-filters-datepicker.png,mautic-contact-batch-delete.png'
taxonomy:
    category:
        - docs
twitterenable: true
twittercardoptions: summary
articleenabled: false
orgaenabled: false
orga:
    ratingValue: 2.5
orgaratingenabled: false
personenabled: false
facebookenable: true
---

---
Lead lists were renamed to segments in Mautic 1.4.0.

Segments provide ways to easily organize your contacts. These segments can be configured from a variety of fields.

When viewing all segments you will notice the column on the right which shows the number of contacts matching that particular segment.

![Screenshot of contact segments](contact-segments.jpg)

## Creating a segment

To create a new segment navigate to Segments in the menu, and click on 'New'.

### Naming segments

Since the 3.2 release it has been possible to provide a public name, in addition to an internal name, for a segment. 

This is used if the segment is displayed in the Preference Centre, allowing the contact to choose to remove themselves from it.  The Public Name is what will be displayed to the contact in the preference centre.

![Screenshot of public segment name showing that it can be customised if used in the preference centre](public-segment-name.png)

### Public and private segments

It is possible to create a segment which is accessible to everybody who uses your Mautic instance - a public segment - or just for your own use - a private segment.

### Making segments available in the preference centre

There are many approaches that can be taken when it comes to allowing contacts to choose communications they wish to receive from you. If you wish to allow them to subscribe and unsubscribe based on segments, you can select the option to make a segment available in the Preference Centre.

Use this in conjunction with the public name to provide a user-friendly description of the segment.

### Publish status

If a segment is unpublished, it will not be available for use in Mautic, and will not show in any dropdown fields.

## Segment Filters

Filters are used to define the contacts who will be in the segment.

![Screenshot showing filter dropdown ](segment-filters.jpg)

In addition, these filters can be combined to either be inclusive or exclusive depending on your needs.

![Screenshot showing boolean options for combining filters](multiple-segment-filters.jpg)

Once you have selected the field you can then choose the type of operation to perform. These vary depending on the way you wish to filter your contacts.

![Screenshot showing selection of options](segment-filters-dropdown.jpg)

If you want to divide your segment based on certain criterion, and you wish to avoid sending duplicate emails to the (sub)segments, you can view and alter them through typing the alias name of the contact segments separated by '+' only. You can add n contact segments to show the contacts they have in common, but you will always receive the result as the intersection of the subsets. You can then manipulate the contacts to remove them from either one subset or all, hence avoiding sending duplicate emails to the same leads in the subsets.

![Screenshot showing common leads in segments](common-leads-in-segments.jpg)

### Matching part of a string

There are 5 filters you can use for matching part of a string - `starts with`, `ends with`, `contains`, `like` and `regexp`. First three filters match strings as you enter it. `like` filter is for advanced users - you can specify which type you want to use with `%` character:

* `My string%` is the same as `starts with` filter with `My string` value.
* `%My string` is the same as `ends with` filter with `My string` value.
* `%My string%` is the same as `contains` filter with `My string` value.
* `My string` is the same as `contains` filter with `My string` value.

A few notes for text filters:

* `starts with`, `ends with`, `contains` filters were added later than the `like` one, so you can easily specify what you need now.
* `%` character in the middle of the string has no special meaning. `contains` filter with `my % string` will search for a string with `%` in the middle. The same is true for `like` filter with `%my % string%` value. There is no need for escaping this character.
* Mautic searches for `%` character in a value for `like` filter and no modification is performed if at least 1 `%` is found.

You can use regular expressions in a `regexp` filter. Mautic recognises all common operators like `|` for OR (`first string|second string`), character sets (`[0-9]`, `[a-z0-9]` etc.), repetitions (`+`, `*`, `?`) and more. You have to escape special characters with `\` if you want to use them as matching character. [Learn more about regex at https://dev.mysql.com/doc/refman/5.7/en/regexp.html](https://dev.mysql.com/doc/refman/5.7/en/regexp.html). Please note that MySQL (and Mautic) uses POSIX regex, which could behave differently from other types of Regex.

### Date options

Date filters allow you to choose a date via DatePicker:

![Screenshot showing date picker](segment-filters-datepicker.png)

Hovewer you can specify much more here. Mautic recognizes relative formats too (these string are not translatable):

* `+1 day` (you can also use `1 day`)
* `-2 days` (you can also use `2 days ago`)
* `+1 week` / `-2 weeks` / `3 weeks ago`
* `+5 months` / `-6 months` / `7months ago`
* `+1 year` / `-2 years` / `3 years ago`

Example (Consider that today is `2018-03-02`):
* `Date identified equals -1 week` returns all contacts identified on 2018-02-23.
* `Date identified less than -1 week` returns all contacts identified before 2018-02-23.
* `Date identified equals -1 months` returns all contacts identified on 2018-02-02.
* `Date identified greater or equal -1 year` returns all contacts identified 2017-03-02 and after.
* `Date identified greater than -1 year` returns all contacts identified after 2017-03-02.

Beside this you can specify your date with text. These formulas are **translatable**, so make sure you use them in correct format.

* `birthday` / `anniversary`
* `birthday -7 days` / `anniversary -7 days`
* `today` / `tomorrow` / `yesterday`
* `this week` / `last week` / `next week`
* `this month` / `last month` / `next month`
* `this year` / `last year` / `next year`

Example (Consider that today is `2018-03-02`):
* `Date identified equals last week` returns all contacts identified between 2018-02-26 and 2018-03-04 (Monday to Sunday).
* `Date identified less than last week` returns all contacts identified before 2018-02-19.
* `Date identified equals last month` returns all contacts identified between 2018-02-01 and 2018-02-28.
* `Date identified greater or equal last year` returns all contacts identified 2017-01-01 and after.
* `Date identified greater than last year` returns all contacts identified after 2017-12-31.
* `Custom contact date field equal birthday -1 day` returns all contacts identified every year on 03-01 (1st march).
* `Custom contact date field equal anniversary -1 month` returns all contacts identified every year on 02-01 (1st february)

## Segments

Once you have created your segment, any applicable contact will be automatically
added through the execution of a cron job. This is the essence of segments.

To keep the segments current, create a cron job that executes the following
command at the desired interval:

> php /path/to/mautic/bin/console mautic:segments:update --env=prod

Through the execution of that command, contacts that match the filters will be
added and contacts that no longer match will be removed. Any contacts that were
manually added will remain part of the list regardless of filters.

## Manual Addition

In addition to segments you can also manually add any contact to a list by
clicking the Preferences button at the segments tab, use the dropdown to select a segment and add the contact to it or click on the x next to a segment in the input field to remove the contact.

## Delete all contacts in a segment

Filter the contacts in the segment. The batch delete action in the contact table allows deletion of up to 100 contacts at one time. This is a performance precaution since deleting more contacts at one time could cause issues. This feature can be used for hundreds of contacts.

![Screenshot showing batch delete](mautic-contact-batch-delete.png)

But deleting thousands of contacts this way in one segment will become a tedious task. Luckily, there is a trick how to let the background workers do the job for you.

1. Create a simple campaign which has the segment as the source \
2. Use the [Delete contact action](./../campaign/campaign_events.html#delete-contact).

This way the `mautic:campaign:update` and `mautic:campaign:trigger` commands will delete all the contacts in the segment. As well as all the contacts which will be added to the segment in the future. Everything is done automatically in the background. The cron jobs must be configured. However, be aware that when a contact is deleted, there is no way to get it back.

![Screenshot showing campaign to delete contacts in a segment](mautic-delete-contacts-in-segment.png)
