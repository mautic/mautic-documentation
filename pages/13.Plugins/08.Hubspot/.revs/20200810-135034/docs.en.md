---
title: Hubspot
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

-------------------

## Mautic - HubSpot CRM plugin

[Mautic][mautic] can push contacts to [HubSpot CRM][Hubspot-crm] based on [Contact actions][testing] or [Point Triggers][points].

## HubSpot API key

1. Create a [HubSpot CRM][Hubspot-crm] account if you don't have one already.

1. Visit [https://app.hubspot.com/api-key][hubspot-keys] to generate your [HubSpot API key][hubspot-keys].

## Configure the HubSpot CRM plugin
>   *Note* Do not publish the plugin until all steps are completed

1. Open the HubSpot Plugin configuration

   - Paste the [API key][hubspot-keys] into the *HubSpot API key* input field.

1. Configure the _Feature Specific Settings_ to determine whether Contacts, Companies or both should be synchronised from HubSpot.

1. Save and close, then edit the plugin to configure the field mapping.

It is checked by default. If you uncheck it, the plugin will not push contacts to [Hubspot CRM][Hubspot-crm] any more.

1. Configure the [field mapping][field-mapping].

1. Save the plugin configuration.

   - If you want to use the plugin, set the *Publish* switch to *Yes*. Only do this when you have fully configured the plugin settings.

    ![Hubspot CRM Plugin configuration](plugins-hubspot-crm-configuration.png "HubSpot CRM Plugin configuration")

1. Set up the [cron job][cron-job] if you have not already configured it.

## Test the plugin

Follow [these steps][testing] to test the integration.

## Troubleshooting

If the contact has not been created, ensure the email address you tested with is valid. Hubspot will only create a new contact when the email address is valid.

## Credit

This plugin had been developed by [@gpassarelli].

[mautic]: <https://mautic.org>
[Hubspot-crm]: <https://www.hubspot.com/crm>
[testing]: </plugins/plugin-resources/testing-integrations>
[points]: </points>
[hubspot-keys]: <https://app.hubspot.com/hapikey>
[field-mapping]: </plugins/plugin-resources/field-mapping>
[cron-job]: </setup/cron-jobs>
[@gpassarelli]: <https://github.com/gpassarelli>