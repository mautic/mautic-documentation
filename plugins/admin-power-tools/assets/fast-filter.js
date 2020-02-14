/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2018 TwelveTone LLC
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
/**
 * Fast client-side element filtering.
 * Elements are filtered by any of the following:
 * - selector and text content
 * - visibility of child selectors
 *
 * Make sure to add the classname fast-filter to your inputs.
 * When the page is reloaded (from cache or not) an enter keydown/keyup will be fired to refresh the filter.
 */

class FastFilter {
    /**
     * Shows or hides elements with text content containing the needle.
     * @param selector
     * @param needle
     */
    static element_text_filter(selector, needle) {
        needle = needle.toLowerCase();
        $(selector).each((index, item) => {
            if (item.textContent.toLowerCase().indexOf(needle) === -1) {
                if (item.style.display !== 'none') {
                    item._oldDisplay = item.style.display;
                    item.style.display = 'none';
                }
            } else {
                if (item.style.display === 'none') {
                    item.style.display = item._oldDisplay;
                }
            }
        });
    }

    /**
     * Shows or hides elements with visible children
     * @param selector
     * @param selectorTest
     */
    static visible_children_filter(selector, selectorTest) {
        $(selector).each((index, item) => {
            let allHidden = true;
            var children;
            if (!selectorTest) {
                children = item.children;
            }
            else {
                children = item.querySelectorAll(selectorTest);
            }
            for (let i = 0; i < children.length; i++) {
                if (children[i].style.display !== 'none') {
                    allHidden = false;
                    break;
                }
            }
            if (allHidden) {
                if (item.style.display !== 'none') {
                    item._oldDisplay = item.style.display;
                    item.style.display = 'none';
                }
            } else {
                if (item.style.display === 'none') {
                    item.style.display = item._oldDisplay;
                }
            }
        });
    }
}

// Make sure filter is reapplied on back() and forward() history operations.
// We trigger a keydown keyup event here.
$(window).on('pageshow', () => {
    $('.fast-filter').each((index, ele) => {
        const e = $.Event('keyup');
        e.keyCode = 13; // enter
        $(ele).trigger(e);
    })
});
