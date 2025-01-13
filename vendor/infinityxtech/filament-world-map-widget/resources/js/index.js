import jsVectorMap from 'jsvectormap';
import 'jsvectormap/dist/jsvectormap.min.css';

/**
 * Initializes the world map widget with the given options.
 * @param {object} options - Options for initializing the map
 * @param {object} options.stats - The stats data, with country codes as keys and values as view counts
 * @param {string} options.tooltipText - Text to display next to the stats in the tooltip
 * @param {string} options.map - The name of the map to use
 * @param {array} options.color - RGB array for the region color
 * @param {string} options.selector - The CSS selector for the HTML element to attach the map
 * @param {object} options.additionalOptions - Additional options to override or extend the default configuration
 */
function initWorldMapWidget({ stats, tooltipText, map, color, selector, additionalOptions = {} }) {
    return {
        stats,

        async init() {
            const self = this;

            // Dynamically import the required map file
            try {
                await import(`jsvectormap/dist/maps/${map.replace('_','-')}.js`);
            } catch (error) {
                console.error(`Error loading map: ${map}. Map file not found.`);
                return;
            }

            const dataValues = self.stats;
            const minValue = Math.min(...Object.values(dataValues));
            const maxValue = Math.max(...Object.values(dataValues));

            const normalizeOpacity = (value, min, max) => 0.3 + ((value - min) / (max - min)) * (1 - 0.3);

            const regionScales = Object.fromEntries(
                Object.entries(dataValues).map(([code, value]) => {
                    const opacity = normalizeOpacity(value, minValue, maxValue);
                    return [code, `rgba(${color[0]}, ${color[1]}, ${color[2]}, ${opacity.toFixed(2)})`];
                })
            );

            const regionValues = Object.fromEntries(
                Object.entries(dataValues).map(([code]) => [code, code])
            );

            // Default options
            const options = {
                selector: selector,
                map: map,
                series: {
                    regions: [{
                        attribute: 'fill',
                        scale: regionScales,
                        values: regionValues,
                    }]
                },
                showTooltip: true,
                onRegionTooltipShow(event, tooltip, code) {
                    const stats = self.stats[code.toUpperCase()] || 0;
                    tooltip.text(
                        `<h5>${tooltip.text()}: ${stats} ${tooltipText}</h5>`,
                        true // Enables HTML
                    );
                }
            };

            // Merge options with additionalOptions, where additionalOptions can override default options
            const mergedOptions = {
                ...options,
                ...additionalOptions,
                series: {
                    regions: [
                        {
                            ...options.series.regions[0],
                            ...additionalOptions.series?.regions?.[0],
                        }
                    ],
                },
            };

            // Initialize the map with merged options
            new jsVectorMap(mergedOptions);
        }
    };
}

// Register the Alpine component
document.addEventListener('alpine:init', () => {
    Alpine.data('initWorldMapWidget', initWorldMapWidget);
});
