/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2018-2020 TwelveTone LLC
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
function ajaxSubmit(form, callback) {
    const xhr = new XMLHttpRequest();
    const params = [].filter.call(form.elements, function (el) {
        return !(el.type in ['checkbox', 'radio']) || el.checked;
    })
        .filter(function (el) {
            return !!el.name;
        }) //Nameless elements die.
        .filter(function (el) {
            return !el.disabled;
        }) //Disabled elements die.
        .map(function (el) {
            return encodeURIComponent(el.name) + '=' + encodeURIComponent(el.value);
        }).join('&'); //Then join all the strings by &
    xhr.open("POST", form.action);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = callback.bind(xhr);
    xhr.send(params);
}


function _post(path, params, callback) {
    const form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", path);

    for (let key in params) {
        if (params.hasOwnProperty(key)) {
            const hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);

    ajaxSubmit(form, (e) => {
        if (callback) {
            callback(e.target);
        }
        else {
            console.log(e);
        }
    });
}

function _postSubmit(path, params) {
    const form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", path);

    for (let key in params) {
        if (params.hasOwnProperty(key)) {
            const hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}

