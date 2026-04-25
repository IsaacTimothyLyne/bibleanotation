import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../wayfinder'
/**
* @see routes/web.php:11
* @route '/settings/security'
*/
export const security = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: security.url(options),
    method: 'get',
})

security.definition = {
    methods: ["get","head"],
    url: '/settings/security',
} satisfies RouteDefinition<["get","head"]>

/**
* @see routes/web.php:11
* @route '/settings/security'
*/
security.url = (options?: RouteQueryOptions) => {
    return security.definition.url + queryParams(options)
}

/**
* @see routes/web.php:11
* @route '/settings/security'
*/
security.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: security.url(options),
    method: 'get',
})

/**
* @see routes/web.php:11
* @route '/settings/security'
*/
security.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: security.url(options),
    method: 'head',
})

const settings = {
    security: Object.assign(security, security),
}

export default settings