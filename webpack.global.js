const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

/**
 * Webpack config (Development mode)
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-scripts/#provide-your-own-webpack-config
 */
module.exports = {
	entry: {
		admin: './assets/admin.js',
		frontend: './assets/frontend.js',
	},
	module: {
		rules: [
			{
				test: /\.(sa|sc|c)ss$/,
				exclude: '/node_modules',
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'postcss-loader',
					'svg-transform-loader/encode-query',
					'sass-loader',
				],
			},
		],
	},
	plugins: [ new MiniCssExtractPlugin() ],
};
