---

template: form-polymer

form:
    name: myform
    fields:
        - name: email
          label: Email
          placeholder: Enter your email...
          type: email
          validate:
            required: true
            
        - name: page
          label: Page
          type: page-picker
          validate:
            required: true
          
    buttons:
        - type: submit
          value: Submit
          
        - type: reset
          value: Reset

    process:      
        - message: Thank you for your feedback!   
             
---

Hello.

This page demonstrates a test form in the Admin plugin.  The form is defined in this page's _frontmatter_.
