---
title: 'Troubleshooting Campaigns'
taxonomy:
    category:
        - docs
slug: troubleshooting-campaigns
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

---------------------

## Page visits are not recognized

To workaround this issue, try one of the following options:

1. Make sure that you are not testing the Page visit while logged into Mautic. Mautic ignores user generated activity. So, it is suggested that you use an anonymous session, another browser, or log out of Mautic.

2) Ensure that the Contact getting tracked is in the Campaign. The easy way to test this is to review the timeline of the Contact for the page hit / being added to the Campaign.

3) Campaigns are executed sequentially and will not repeat per Contact. If the Contact has already visited the Page while part of the Campaign and triggered the Visits a Page decision, then the Contact's subsequent visits will not re-trigger the actions associated with the decision.

4) Ensure that the URL in the campaign action either matches _exactly_ the URL visited or use a wildcard. [A URL can include the schema, host/domain, path, query parameters, and/or fragment][url]). For example, if you have a URL of `http://example.com` and the page hit registers as `http://example.com/index.php?foo=bar`, the campaign decision will not be triggered. However, if you use `http://example.com*` as the URL, it'll match and thus trigger.

Another example is if you want to associate different page hits with specific campaigns. Let's say you have Campaign A and Campaign B. You want to use the same base URL and path for both campaigns but differentiate with a query parameter.  For Campaign A, you can define a Visits a Page decision with `http://example.com/my-page?utm_campaign=A*` and for Campaign B, `http://example.com/my-page?utm_campaign=B*`. A contact will only trigger the specific campaign desired. If the goal is to trigger both campaigns regardless of the query parameters, use `http://example.com/my-page*`.

[url]: <https://en.wikipedia.org/wiki/Uniform_Resource_Locator>
