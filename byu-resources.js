'use strict';
import {LitElement} from '@polymer/lit-element';
const util = require('byu-web-component-utils');
const template = require('./byu-resources.html');

class ByuResources extends LitElement {

  _createRoot() {
    return this.attachShadow({ mode: 'open' });
  }

  _render({}) {

  }

  connectedCallback() {
    super.connectedCallback();
    util.applyTemplate(this, 'byu-resources', template, () => {

      //Web Components
      let element = this.shadowRoot.querySelector('#resources');
      jQuery.getJSON('https://cdn.byu.edu/manifest.json', function(data) {
        let html = '';
        jQuery.each(data.libraries, function(name, library) {
          if (library.type == 'web-component') {
            html += '<byu-feature-card class="gray-title">' +
              '<div slot="title">' + library.name + '</div>' +
              '<div slot="feature-left"><img class="resource-icon" src="./modules/custom/byu_resources/icons/html5-200px.png"></div>' +
              '<div slot="feature-right"><strong>CMS: </strong> HTML 5' +
              '<br><strong>Maintainer: </strong> Web Community' +
              '<br><strong>Contact: </strong> web_community@byu.edu</div>' +
              '<div slot="feature-center">' + library.description + '</div>' +
              '</byu-feature-card>';
          }
        });
        element.innerHTML = html;
      });
    });

    // $.getJSON('https://www.drupal.org/brigham-young-university', function(data) {console.log(data)});
  }
}

window.customElements.define('byu-resources', ByuResources);
window.ByuResources = ByuResources;