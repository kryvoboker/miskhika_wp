const { src, dest, watch, parallel, series } = require('gulp');

const scss = require('gulp-sass');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify-es').default;
const autoprefixer = require('gulp-autoprefixer');
const del = require('del');
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename');
const babel = require("gulp-babel");
const sourcemaps = require("gulp-sourcemaps");

function browsersync() {
	browserSync.init({
		server: {
			baseDir: './'
		}
	});
}

function cleanDist() {
	return del('dist')
}

function images() {
	// return src('app/img/**/*', { base: 'app' })
	return src('app/temp_convert/*')
		.pipe(imagemin([
			imagemin.gifsicle({ interlaced: true }),
			imagemin.mozjpeg({ quality: 50, progressive: true }),
			imagemin.optipng({ optimizationLevel: 5 }),
			imagemin.svgo({
				plugins: [
					{ removeViewBox: true },
					{ cleanupIDs: false }
				]
			})
		]))
		.pipe(dest('app/temp_convert'))
}

function conWebp() {
	return src('app/temp_convert/*')
		.pipe(webp({ quality: 45 }))
		.pipe(dest('app/temp_convert'))
}

function babelJS() {
	return src([
		// 'assets/js/slick.min.js',
		// 'assets/js/select.js',
		// 'src/js/ajax-main.js',
		// 'src/js/ajaxLoadMore.js',
		// 'src/js/axios.js'
		// 'assets/js/main.js'
	])
		.pipe(sourcemaps.init({ largeFile: true }))
		.pipe(babel())
		// .pipe(rename({ suffix: '.BBL' }))
		// .pipe(concat("main.min.js"))
		// .pipe(uglify())
		.pipe(sourcemaps.write("."))
		.pipe(dest('src/assets/js/lib/'))
		.pipe(browserSync.stream())
}

function babelConJS() {
	return src([
		'src/assets/js/slick.min.js',
		'src/assets/js/select.js',
		'src/assets/js/main.js'
	])
		.pipe(sourcemaps.init({ largeFile: true }))
		.pipe(babel())
		.pipe(concat("main.min.js"))
		.pipe(uglify())
		.pipe(sourcemaps.write("."))
		.pipe(dest('src/assets/js/'))
		.pipe(browserSync.stream())
}

function babelConJSProjects() {
	return src([
		'src/assets/js/projects/jquery.fancybox.min.js',
		'src/assets/js/projects/imagesLoaded.min.js',
		'src/assets/js/projects/masonry.min.js',
		// 'src/assets/js/projects/select.js',
		'src/assets/js/projects/main.js'
	])
		.pipe(sourcemaps.init({ largeFile: true }))
		.pipe(babel())
		.pipe(concat("projects.min.js"))
		.pipe(uglify())
		.pipe(sourcemaps.write("."))
		.pipe(dest('src/assets/js/projects/'))
		.pipe(browserSync.stream())
}

// function scripts() {
// 	return src([
// 		// 'node_modules/jquery/dist/jquery.js',
// 		'assets/js/slick.min.js',
// 		'assets/js/select.js',
// 		'assets/js/main.js'
// 	])
// 		.pipe(concat('main.min.js'))
// 		.pipe(uglify())
// 		.pipe(dest('assets/js'))
// 		.pipe(browserSync.stream())
// }

function scripts() {
	return src([
		// 'node_modules/jquery/dist/jquery.js',
		'app/pages/js/jquery.fancybox.min.js',
		'app/pages/js/imagesLoaded.min.js',
		'app/pages/js/masonry.min.js',
		// 'app/pages/js/select.js',
		'app/pages/js/main.js'
	])
		.pipe(concat('main.min.js'))
		.pipe(uglify())
		.pipe(dest('app/pages/js'))
		.pipe(browserSync.stream())
}

function styles() {
	return src('src/assets/#source/scss/style.scss')
		.pipe(scss({ outputStyle: 'compressed' }))
		.pipe(concat('style.css'))
		.pipe(autoprefixer({
			overrideBrowserslist: ['last 10 version'],
			grid: true
		}))
		.pipe(dest('src/assets/css'))
		.pipe(browserSync.stream())
}

function styles_projects() {
	return src('src/assets/#source_projects/scss/style.scss')
		.pipe(scss({ outputStyle: 'compressed' }))
		.pipe(concat('style_projects.css'))
		.pipe(autoprefixer({
			overrideBrowserslist: ['last 10 version'],
			grid: true
		}))
		.pipe(dest('src/assets/css'))
		.pipe(browserSync.stream())
}

function CSSmini() {
	return src([
		'app/pages/css/select.css'
	])
		.pipe(cssmin())
		.pipe(rename({ suffix: '.min' }))
		.pipe(dest('app/pages/css'));
}

function concatCSS() {
	return src([
		'src/assets/css/slick.min.css',
		'src/assets/css/fonts.min.css',
		'src/assets/css/select.min.css',
		'src/assets/css/style.css'
	])
		.pipe(concat('style.css'))
		.pipe(dest('./'))
		.pipe(browserSync.stream())
}

function concatCSS_projects() {
	return src([
		'src/assets/css/jquery.fancybox.min.css',
		'src/assets/css/style_projects.css'
	])
		.pipe(concat('projects.min.css'))
		.pipe(dest('src/assets/css'))
		.pipe(browserSync.stream())
}

function build() {
	return src([
		'app/pages/css/style.min.css',
		'app/pages/fonts/**/*',
		'app/pages/img/**/*',
		'app/pages/js/main.min.js',
		'app/pages/*.html'
	], { base: 'app/pages' })
		.pipe(dest('dist/pages'))
}

function watching() {
	watch(['src/assets/#source/scss/**/*.scss'], styles);
	watch(['src/assets/#source_projects/scss/**/*.scss'], styles_projects);
	// watch(['assets/pages/#source/scss/**/*.scss'], styles);
	// watch(['app/pages/#source/scss/**/*.scss'], styles);
	watch(['src/assets/css/**/*.css', '!src/assets/css/style.min.css'], concatCSS);
	watch(['src/assets/css/**/*.css', '!src/assets/css/projects.min.css'], concatCSS_projects);
	// watch(['app/pages/css/**/*.css', '!app/pages/css/style.min.css'], concatCSS);
	// watch(['assets/js/**/*.js', '!assets/js/main.min.js'], scripts);
	// watch(['app/pages/js/**/*.js', '!app/pages/js/main.min.js'], scripts);
	watch(['src/assets/js/**/*.js', '!src/assets/js/main.min.js'], babelConJS);
	watch(['src/assets/js/projects/**/*.js', '!src/assets/js/projects/projects.min.js'], babelConJSProjects);
	// watch(['src/js/**/*.js'], babelJS);
	// watch(['assets/pages/js/**/*.js', '!assets/pages/js/main.min.js'], scripts);
	watch(['./index.php']).on('change', browserSync.reload);
	// watch(['/pages/*.html']).on('change', browserSync.reload);
}

exports.styles = styles;
exports.watching = watching;
exports.browsersync = browsersync;
exports.scripts = scripts;
exports.images = images;
exports.conWebp = conWebp;
exports.cleanDist = cleanDist;
exports.CSSmini = CSSmini;
exports.concatCSS = concatCSS;
exports.babelConJS = babelConJS;
exports.babelConJSProjects = babelConJSProjects;
exports.styles_projects = styles_projects;
exports.concatCSS_projects = concatCSS_projects;
// exports.babelJS = babelJS;


exports.build = series(build);
exports.default = parallel(styles, styles_projects, concatCSS, concatCSS_projects, babelConJS, babelConJSProjects, browsersync, watching);
// exports.default = parallel(styles, concatCSS, scripts, browsersync, watching);