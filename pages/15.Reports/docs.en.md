---
title: Reports
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

-----------

Highly customizable reports can be generated through Mautic's Report menu.

## Data Sources

Choose the data source appropriate to the report you want. Each data source has a different set of available columns, filters and graphs.

![](data-source.png)

## Configuration

Each report can be customized to include the columns of choice. Filter data based on set criteria and/or set a specific order for the data.
In addition you can also group by and select different function operators to calculate fields. Note that when you select functions operators a totals row will be added to the report. This totals row will not be exported when selecting to export a report.

![](config.png)

## Graphs

Some reports have graphs available. Select the graph desired from the left list - it will move to the right and will be part of the report.

![](graphs.png)

## Dashboard Widget

Each graph of each report is made available as a widget on the dashboard allowing complete customization of the dashboard.

![](widget.png)

## Schedule

Enable or disable sending reports via emails by using the toggle switch. You can schedule emails to send reports to one or more email address. In the To field, enter a comma-separated list of email addresses and set the frequency of sending reports by choosing day, week, or month from the drop-down list. To be able to schedule emails to send reports, run the command:

```
php /path/to/mautic/app/console mautic:reports:scheduler [--report=ID]
```

![](schedule.png)
