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

4) Ensure that the URL in the Campaign action either matches _exactly_ the URL visited, or use a wildcard. A URL can include the [schema, host/domain, path, query parameters, and/or fragment][url]). For example, if you have a URL of `https://example.com` and the page hit registers as `https://example.com/index.php?foo=bar`, the Campaign decision will not be triggered. However, if you use `https://example.com*` as the URL, it will match and thus trigger.

Another example is if you want to associate different page hits with specific Campaigns. Let's say you have Campaign A and Campaign B. You want to use the same base URL and path for both Campaigns but differentiate with a query parameter.  For Campaign A, you can define a Visits a Page decision with `https://example.com/my-page?utm_campaign=A*` and for Campaign B, `https://example.com/my-page?utm_campaign=B*`. A Contact will only trigger the specific Campaign desired. If the goal is to trigger both Campaigns regardless of the query parameters, use `https://example.com/my-page*`.

[url]: <https://en.wikipedia.org/wiki/Uniform_Resource_Locator>
