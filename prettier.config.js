export default {
  semi: true,
  singleQuote: true,
  printWidth: 100,
  tabWidth: 2,
  useTabs: false,
  trailingComma: 'es5',
  bracketSpacing: true,
  arrowParens: 'always',
  endOfLine: 'lf',

  vueIndentScriptAndStyle: true,
  singleAttributePerLine: true,

  overrides: [
    {
      files: '*.vue',
      options: {
        parser: 'vue',
      },
    },
    {
      files: '*.ts',
      options: {
        parser: 'typescript',
      },
    },
    {
      files: '*.js',
      options: {
        parser: 'babel',
      },
    },
  ],
};
