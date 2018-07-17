'use strict';
import {LitElement} from '@polymer/lit-element';

class ByuResources extends LitElement {

  _render({}) {

  }

  connectedCallback() {
    super.connectedCallback();
    (function($) {
      $.getJSON('https://cdn.byu.edu/manifest.json', function(data) {
        $.each(data.libraries, function(name, library) {
          if (library.type == 'web-component') {
            console.log(library.name);
            console.log(library.description);
          }
        })
      });
    })(jQuery);

    // $.getJSON('https://www.drupal.org/brigham-young-university', function(data) {console.log(data)});
  }
}

window.customElements.define('byu-resources', ByuResources);
window.ByuResources = ByuResources;