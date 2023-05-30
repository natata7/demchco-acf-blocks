const { watch } = require( 'gulp' );
let gulp = require( 'gulp' );
let gutil = require( 'gulp-util' );
let ftp = require( 'vinyl-ftp' );

const ftpCredentials_from_file = JSON.parse(
	JSON.stringify( require( './gulpfile-host-credentials.json' ) )
);

const ftpCredentials = {
	host: ftpCredentials_from_file.host,
	//port: port,
	user: ftpCredentials_from_file.user,
	password: ftpCredentials_from_file.password,
	reload: true,
	//log: gutil.log,
};

let globs = [
	'**/*',
	// "!gulpfile.js", //!passwords
	// '!package.json',
	// '!package-lock.json',
	'!gulpfile-host-credentials.json', //!passwords
	'!node_modules/**', //don't load node_modules
];

const conn = ftp.create( ftpCredentials );

const dirDeploy = '/spravdi/wp-content/plugins/demchco-acf-blocks';

function deploy() {
	return gulp
		.src( globs, { buffer: false } )
		.pipe( conn.newerOrDifferentSize( dirDeploy ) ) // only upload newer files
		.pipe( conn.dest( dirDeploy ) );
}

// Ожидаем изменений
function watchFiles() {
	watch( '.', deploy );
}

exports.default = watchFiles;
