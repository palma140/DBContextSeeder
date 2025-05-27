module.exports = {
    title: 'DBContextSeeder Docs',
    tagline: 'Official Documentation',
    url: 'https://palma140.github.io', // Seu username GitHub
    baseUrl: '/DBContextSeeder/', // Nome do repositório
    onBrokenLinks: 'throw',
    onBrokenMarkdownLinks: 'warn',
    favicon: 'img/favicon.ico',
    organizationName: 'palma140', // GitHub username
    projectName: 'DBContextSeeder', // Nome do repo
    trailingSlash: false,
    presets: [
        [
            'classic',
            {
                docs: {
                    routeBasePath: '',
                },
                blog: false,
                theme: {
                    customCss: require.resolve('./src/css/custom.css'),
                },
            },
        ],
    ],
};
