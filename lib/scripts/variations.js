const UCSC_MEDIA_COVERAGE_LOOP = 'ucsc-news-functionality/media-coverage-loop';
const UCSC_NEWS_ARTICLE_LOOP = 'ucsc-news-functionality/news-article-loop';

const { registerBlockVariation } = wp.blocks;

registerBlockVariation( 'core/query', {
    name: UCSC_MEDIA_COVERAGE_LOOP,
    title: 'Media Coverage Loop',
    description: 'This block displays Media Coverage items',
    isActive: ( { namespace, query } ) => {
        return (
            namespace === UCSC_MEDIA_COVERAGE_LOOP
            && query.postType === 'media_coverage'
        );
    },
    icon: 'editor-ul',
    attributes: {
        namespace: UCSC_MEDIA_COVERAGE_LOOP,
        query: {
            perPage: 9,
            pages: 0,
            offset: 0,
            postType: 'media_coverage',
            order: 'desc',
            orderBy: 'date',
            author: '',
            search: '',
            exclude: [],
            sticky: '',
            inherit: true,
        },
    },
    scope: [ 'inserter' ],
    innerBlocks: [
    ['core/post-template',{"layout":{"type":"default","columnCount":3}},
        [
            ['core/columns', {"isStackedOnMobile":false,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}},[
                ['core/column',{"width":"20%"},
                    [
                        [ 'core/post-featured-image' ]
                    ]    
                ],
                ['core/column',{"width":"80%"},
                    [
                        ['core/group', {"style":{"spacing":{"padding":{"top":"0px","right":"20px","bottom":"0px","left":"20px"},"blockGap":"1rem"}},"layout":{"inherit":false}},[
                            ['acf/article-source', {"name":"acf/article-source","mode":"preview","className":"ucsc-media-coverage-block__post-source","textColor":"dark-gray","style":{"elements":{"link":{"color":{"text":"var:preset|color|dark-gray"}}}}}],
                            [ 'core/post-title', {"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}}} ],
                            [ 'core/post-date'],
                            [ 'core/post-excerpt' ]
                        ]]    
                    ]    
                ]
            ]]
        ],
    ],
    [ 'core/query-pagination' ],
    [ 'core/query-no-results' ],
],
    }
);


