---
title: 'Amazon S3'
published: false
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

The Amazon S3 plugin allows you to host your [Assets][assets] on Amazon S3 instead of hosting them on your local server.

To get started, you need to sign up for an Amazon account.  Ensure you are familiar with the [pricing tiers for S3][s3-pricing-tiers] before you commit to using it.

Follow these steps to set up your Amazon S3 account if you are new to Amazon Web Services. This is an important step to ensure that you are not carrying out day-to-day tasks with your root account:

1. [Sign up for an AWS account][aws-signup]
1. [Set up an IAM user][create-iam-user]
1. [Sign in as IAM user][sign-in-iam-user]
1. [Set up your bucket][set-up-bucket]

> Note: The region you select for your bucket is important from a data protection perspective. Consult your privacy policy and act accordingly.

Now you have created a bucket, we need to create a user which has the ability to access this bucket. We'll use the credentials for this user in Mautic - rather than your master account (which exposes you to significant risk if the credentials were ever exposed).

Select your account name in the top right corner, then select "My Security Credentials" from the drop-down list.  Choose Users > Add User and provide a name. Select 'programmatic access'.






[assets]: </components/assets>
[s3-pricing-tiers]: <http://aws.amazon.com/s3>
[aws-signup]: <https://docs.aws.amazon.com/AmazonS3/latest/gsg/SigningUpforS3.html#sign-up-for-aws-gsg>
[create-iam-user]: <https://docs.aws.amazon.com/AmazonS3/latest/gsg/SigningUpforS3.html#create-an-iam-user-gsg>
[sign-in-iam-user]: <https://docs.aws.amazon.com/AmazonS3/latest/gsg/SigningUpforS3.html#signing-in-iam-user-gsg>
[set-up-bucket]: <https://docs.aws.amazon.com/AmazonS3/latest/gsg/CreatingABucket.html>