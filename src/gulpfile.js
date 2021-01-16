const { src, dest, parallel, series, watch } = require("gulp");
const sass = require("gulp-sass");
const browserSync = require("browser-sync");
const path = require("path");
const concat = require("gulp-concat");
const cleanCSS = require('gulp-clean-css');
const rename = require("gulp-rename");
const appPaths = require("./gulp/paths");


const { removeThemePathFromFilePath } = require("./gulp/gulp-tasks/utils");

// Load the tasks
const js = require("./gulp/gulp-tasks/JsTask");
const jsPlugins = require("./gulp/gulp-tasks/JsPlugins");

/**
 * The task to convert the SASS file into css
 */
function css() {
  let relativePath;
  return src(appPaths.sass, { sourcemaps: true })
    .pipe(sass())
    .pipe(
      rename((file) => {
        const result = removeThemePathFromFilePath(file, "../../../");
        relativePath = file.dirname;
        return result;
      })
    )
    .pipe(cleanCSS())
    .pipe(
      dest(
        (file) => {
          // We go two levels up (`src/sass`), to the root folder
          finalPath = path.resolve(file.base, relativePath, "../../", "dist/css");
          return finalPath;
        },
        { sourcemaps: true }
      )
    )
}

/**
 * The Watch task, that'll watch the JS and SASS files and trigger a reload / style injection
 */
function watchTask() {
  watch(appPaths.jsPath, series(js));
  watch(appPaths.jsPluginsPath, series(jsPlugins));
  watch(appPaths.php);
  watch(appPaths.sass, css), series(sass);
}

/**
 * The dev entry point, it will run the jsPlugins, JS, CSS then start the BrowserSync.
 * Then it will watch the files for any changes and run the required tasks.
 */
const dev = series(jsPlugins, js, css, watchTask);

exports.js = js;
exports.jsPlugins = jsPlugins;
exports.css = css;
exports.dev = dev;
exports.default = parallel(css, js, jsPlugins, dev);
