---
title: A/B testing
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

---------------------

# Mautic A/B Testing: Sending Winner Variant to Contacts

Mautic's new feature allows users to run A/B testing with a segment of their contacts, determine the winning variant based on pre-configured criteria, and then send the winning email to the remaining contacts in the segment.

## How it Works

Let's go through an example:

1. **Setting up the A/B Test**:

   Assume you have a segment of 1,000 contacts. You create an A/B Test with three different emails (A, B, and C). You set the parent email to use 10% of all emails for the A/B tests, with a 3-hour delay to determine the winning email. The two children emails are each set to 33%.

   The distribution may look like this:
    - Email A: sent to 34 people
    - Email B: sent to 33 people
    - Email C: sent to 33 people

2. **Determining the Winning Criteria**:

   For this test, let's say you've set the 'winning criteria' as the email open rate. The results come back as follows:
    - Email A: Open rate is 25%
    - Email B: Open rate is 15%
    - Email C: Open rate is 10%

3. **Sending the Winning Email**:

   After the pre-determined amount of time (3 hours in this case), the winning email (Email A) is sent to the remaining 70% of the segment using the standard `mautic:broadcast:send` command.

## Commands

- `mautic: email:sendwinner` searches for all emails with variant settings for automatically sending the winning variant. This command can be used by a cron job.
- `mautic: email:sendwinner --id=101` works for a single email only.

## Important Points

- To send the A/B test, the 'Send' button forces emails to be sent with publish dates as broadcast emails with `mautic:broadcast:send` command.
- Once a variant is chosen as the winner with command `mautic: email:sendwinner`, the other emails are set as unpublished, and the winning email becomes a regular email.
- The winning email is then sent as a regular email to the remaining contacts using `mautic:broadcast:send`.

# Setting Up A/B Testing in Mautic Emails

This guide will walk you through the process of enabling and setting up A/B tests for your emails in Mautic.

## Enable and Setup A/B Tests for Email

During the process of creating an email, you will have the option to enable and set up A/B tests.

![Email A/B Testing Setup](https://github.com/mautic/mautic/assets/462477/c933fbfb-38b9-4476-8263-0ceac3d86505)

## Create Variant from Parent Email

Once you have a parent email, you can create a variant from it. This variant will serve as an alternative to the original email for the A/B test.

![Creating Variant](https://github.com/mautic/mautic/assets/462477/e6e98269-3e2f-4710-be62-98293840885c)

## Setup Traffic for Children Email

After creating a variant, you can set up the amount of traffic (or percentage of contacts) that each variant will be sent to.

![Setting Up Traffic](https://github.com/mautic/mautic/assets/462477/abf11ca6-3fb4-4c79-89dd-76017dbc2c2f)

## A/B Testing Summary

After setting up your A/B test, you can view a summary of your setup. This summary includes information on the parent email, the variants, and the distribution of traffic between them.

![A/B Testing Summary](https://github.com/mautic/mautic/assets/462477/8a872dfd-7a68-45d4-95c7-4b5dd3942aa1)

For further testing and adjustments, make use of Mautic's `mautic: email:sendwinner` command to send the winning variant, which can be used by a cron job for automatic sending, and make sure to regularly check the performance of your variants.


