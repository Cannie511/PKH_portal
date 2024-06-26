module.exports = {
  // configuration
  entry: './angular_customer/index.main.js',
  output: {
    filename: 'app-customer.js'
  },
  module: {
    loaders: [{
      test: /\.js?$/,
      exclude: /(node_modules|bower_components)/,
      loader: 'babel', // 'babel-loader' is also a legal name to reference
      query: {
        presets: ['es2015'],
        cacheDirectory: true
      }
    }]
  }
}
