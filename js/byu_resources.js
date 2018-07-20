(function($) {
  $.getJSON('https://cdn.byu.edu/manifest.json', function(data) {
    let html = '';
    $.each(data.libraries, function(name, library) {
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
    $('#resources').html(html);
  });
})(jQuery);