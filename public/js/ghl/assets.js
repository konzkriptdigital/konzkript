/*!************************************!*\
  !*** ./resources/js/ghl/assets.js ***!
  \************************************/
var Assets = {
  init: function init() {
    this.css();
    this.js();
    // this.svg();
  },
  css: function css() {
    /**
     * Initializes the CSS files by appending them to the DOM.
     * @returns {void}
     */
    var files = [];
    this.appendFile(files, 'css');
  },
  js: function js() {
    /**
     * Initializes the JavaScript files by appending them to the DOM.
     * @returns {void}
     */
    var files = [{
      name: 'svgSprites',
      link: KONZKRIPT_HELPER.getScriptBaseUrl() + '/storage/js/sprites.js'
    }];
    this.appendFile(files, 'js').then(function (result) {
      document.body.insertAdjacentHTML('afterbegin', konzkriptSprites);
    });
  },
  appendFile: function appendFile(files, type) {
    /**
     * Appends the specified files to the DOM.
     * @param {object[]} files - An array of objects representing the files to be appended.
     * @param {string} type - The type of files to be appended.
     * @returns {Promise<void>} A Promise that resolves when all files have been appended.
     */
    return new Promise(function (resolve, reject) {
      if (!files.length) {
        resolve(); // Resolve immediately if no files
        return;
      }
      var filesLoaded = 0;
      files.forEach(function (file) {
        var doc = null;
        if (!document.getElementById(file.name)) {
          if (type === 'css') {
            doc = document.createElement("link");
            doc.rel = "stylesheet";
            doc.href = file.link;
            doc.id = file.name;
          } else {
            doc = document.createElement("script");
            doc.src = file.link;
            doc.id = file.name;
          }
          doc.onload = function () {
            filesLoaded++;
            if (filesLoaded === files.length) {
              resolve(file); // Resolve the promise once all files are loaded
            }
          };
          doc.onerror = function () {
            reject(new Error("Failed to load ".concat(file.link))); // Reject on error
          };
          document.querySelector("head").appendChild(doc);
        }
      });
    });
  }
};
