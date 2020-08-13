---
title: Trello
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

-------------------

## Mautic - Trello plugin

Dieses Plugin erstellt eine Trello-Karte basierend auf einem Mautic Kontakt.

### Anforderungen

- Mautic V3.02
- Trello

### Autorisieren Sie das Plugin

1. Öffnen sie die Trello-Plugin-Einstellungen (Einstellungen > Plugins)
   <img src="media/trello-plugin-settings-en.png" alt="Trello Plugin Settings" width="400"/>
2. Öffnen sie [https://trello.com/app-key](https://trello.com/app-key) in einem separaten Fenster..
   <img src="media/trello-app-key-en.png" alt="Get auth keys on Trello" width="400"/>
3. Kopieren sie den angezeigten Schlüssel (Key) und fügen Sie ihn zu den Plugin-Einstellungen hinzu.
4. Klicken Sie auf "Token" generieren unter [https://trello.com/app-key](https://trello.com/app-key)
5. Folgen Sie dem Autorisierungsprozess bei Trello
6. Kopieren Sie das angezeigte Token und fügen Sie es zu den Einstellungen des Trello-Plugins hinzu

Vergessen Sie nicht, *Veröffentlicht* auf *Ja* umzuschalten und die Konfiguration zu speichern.

#### Achtung
Möglicherweise möchten sie für den Berechtigungsprozess einen separaten Trello-Benutzer verwenden. Jeder Mautic Benutzer wird in der Lage sein, die Namen aller Trello Boards und Listen zu sehen, auf die dieser Benutzer Zugriff hat und darin Karten zu erstellen. Die einzelnen Trello Karten bleiben verborgen.

### Konfigurieren sie das Plugin

Gehen sie zu Ihren Einstellungen und stellen sie ihr bevorzugtes Board ein. Zur Zeit können sie das Plugin nur mit einem Lieblings-Board verwenden.