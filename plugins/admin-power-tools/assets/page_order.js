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
function enablePageOrdering(itemSelector, inputSelector) {

    const pad = (n, s) => (`000${n}`).substr(-s);

    let orderingElement = $(itemSelector);
    if (orderingElement.length) {
        // Ordering = 
        new AdminPowerTools.Sortable(orderingElement.get(0), {
            filter: '.ignore',
            onUpdate: function () {
                let indexes = [];
                const children = orderingElement.children();
                const padZero = (children.length + '').split('').length;
                children.each((index, item) => {
                    item = $(item);
                    indexes.push(item.data('id'));
                    const padded = `${pad(index + 1, padZero)}.`;
                    item.find('.page-order').text(padded);
                });

                $(inputSelector).val(indexes.join(','));

                if (true) {
                    _ajaxPost(window.GravAdmin.config.base_url_relative + "/powertools/reorder", {childOrder: indexes, parentRoute: GravAdmin.config.route});
                }
            }
        });
    }
}

$(document).ready(() => {
    enablePageOrdering('#ordering-child', '[data-order-child]');
});
