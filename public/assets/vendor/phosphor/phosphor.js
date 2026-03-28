(function () {
  var head = document.getElementsByTagName("head")[0];

  if (!head) {
    return;
  }

  var basePath = document.currentScript
    ? document.currentScript.src.replace(/phosphor\.js(\?.*)?$/, "")
    : "";

  var files = [
    "photoshoper.css",
    "phosphor-thin.css",
    "phosphor-light.css",
    "phosphor-bold.css",
    "phosphoe-fill.css",
    "phosphor-duotone.css",
  ];

  files.forEach(function (file) {
    var link = document.createElement("link");
    link.rel = "stylesheet";
    link.type = "text/css";
    link.href = basePath + file;
    head.appendChild(link);
  });
})();
