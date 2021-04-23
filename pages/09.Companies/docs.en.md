---
title: Companies
media_order: 'primary-company.png,Mautic-31-company-view.png'
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

Companies are a way to group contacts based on the company(ies) the contact is assigned to.

## Company overview

Introduced in 3.1.0, each company has a detail page where you can see what Mautic knows about them.

![Mautic Company Overview Page](Mautic-31-company-view.png)

### Engagements/Points chart
The Engagements line chart display how active the contacts of the company were in the past 6 months. Engagement is any action the contacts made. E.g. page hit, form submission, email open and so on. The chart displays also the sum of points the contacts received.

### List of contacts assigned
Above the informations of the company (name, address, and all you custom company fields) and the chart, you can find a table with the list of the assigned contacts displaying the date of their last activity. A good way to have a view of the recent activity of the contacts you know in this company!

Note also that since 3.1 it is possible to add the column 'date added to company' to reports.

### Company duplicates

Company name field is mark as unique identifier by default. But you can choose any other company fields as unique identifier in [custom fields][custom fields]. 

In Configurations > Company Settings you can choose operator for the merge companies by the unique identifiers.

![Setup operator for find duplications algorithm](company-duplicates-configuration-operator.png "Setup operator for find duplications algorithm")

These settings use algorithm to find and merge duplicates companies during the import, [integrations framework][integration-framework] and other parts of Mautic



## Company actions

### Merging Companies

When editing a company, you can merge this company into another existing company by using the **_Merge_** button.

Search for the company you wish to merge into and the fields from the current company that are not populated in the selected company will be copied to the selected company. Contacts that are not in the selected company will also be transferred.

After the current company has been merged into the selected company, you will be redirected to the selected company and the old company will be deleted from the database.

### Company Custom Fields

With Mautic's installation a set of custom fields is provided for companies, but you can customize these fields to your needs.

1. Go to _Custom Fields_ and create any company field you need.
1. Go to the right select box to assign this field to 'Company'.

### Company Segments

You can create a segment based on a company record, simply select any company field to filter with and the matching criteria for it, and contacts that match any company filtered will be added to the segment.

### Identifying Companies

Companies are identified strictly through a matching criteria based on Company Name, City, Country (and/or State). If city of country are not delivered as identifying fields to identify a contact, a company will not be matched or created.

### Campaign Company Actions

A contact can be added to a new company based on a campaign action

#### Create/Manage Companies

To create or manage companies, go to the companies menu identified by the building icon. In this area you can create, edit or delete companies.

#### Assigning Companies to Contacts

There are different ways to assign a company to a contact, all explained next:

##### Contact's Profile

You can assign a contact to companies in the contact's profile page when creating or editing an existing one. The latest company assigned will be treated as the primary company for the contact.

##### Contacts List View

You can batch assign companies to selected contacts in the contact's list view.

##### Through a Campaign

You can assign a company to identified contacts through a campaign by selecting the 'Assign contact to company' action.

##### When Identifying a Contact Through a Form

If a contact is identified through a form a company can also be identified/created if:

- Company name is selected as a form field (mandatory for company matching/creation).
- City is selected as a form field (mandatory for company matching/creation).
- Country is selected as a form field (mandatory for company matching/creation).
- State is selected as a form field (optional for company matching/creation).

### Company Scoring

A companies score can be changed through a campaign action or a form action. When one of these actions is selected, first a contact must be identified, and the companies assigned to that contact will have their score changed.

1. Select contact's _Change company score_ action in either a form or a campaign
1. Once a form is submitted or a campaign is triggered it will identify companies identified in the campaign or form to change its score.

### Setting Primary Company

As of [Mautic 2.3.0][release-2.3.0], it is now possible to set primary company through the Contact details page.

![primary company](primary-company.png)

<!-- Page Links -->

[release-2.3.0]: <https://github.com/mautic/mautic/releases/tag/2.3.0>
[custom fields]: </contacts/manage-custom-fields>
[integration-framework]: <https://developer.mautic.org/#integration-framework>