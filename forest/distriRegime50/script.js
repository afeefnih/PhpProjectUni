document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('forestCanvas');
    const ctx = canvas.getContext('2d');
    const zoomInBtn = document.getElementById('zoomInBtn');
    const zoomOutBtn = document.getElementById('zoomOutBtn');

    // Get the canvas dimensions
    const canvasWidth = canvas.width;
    const canvasHeight = canvas.height;

    let zoomLevel = 1;
    const zoomFactor = 1.2;
    const minGridSize = 10;
    const minZoomLevel = minGridSize / 100;

    // Store the initial scroll positions
    let initialScrollLeft = 0;
    let initialScrollTop = 0;

    // Store the initial mouse position when dragging
    let initialMouseX = 0;
    let initialMouseY = 0;

    // Store the current scroll offsets
    let scrollOffsetX = 0;
    let scrollOffsetY = 0;

    // Flag to indicate dragging state
    let isDragging = false;

    // Function to fetch forest data from the PHP file
    async function fetchForestData() {
        try {
            const response = await fetch('getForestData.php');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching forest data:', error);
            return [];
        }
    }

    // Function to draw the grid
    function drawGrid() {
        const gridSize = 100 * zoomLevel; // Adjust grid size based on zoom level
        ctx.clearRect(0, 0, canvasWidth, canvasHeight); // Clear the canvas

        ctx.strokeStyle = 'black';
        ctx.lineWidth = 1;
        ctx.font = `${12 * zoomLevel}px Arial`;
        ctx.fillStyle = 'black';

        // Set fixed number of grid lines and their spacing
        const gridLines = 10;

        for (let i = 0; i <= gridLines; i++) {
            const x = i * gridSize - scrollOffsetX;
            ctx.beginPath();
            ctx.moveTo(x, 0);
            ctx.lineTo(x, canvasHeight);
            ctx.stroke();

            // Draw the number for the vertical grid line
            if (x < canvasWidth && x >= 0) {
                ctx.fillText(i + 1, x + 5, 15 * zoomLevel); // Numbers from 1 to 10
            }

            const y = i * gridSize - scrollOffsetY;
            ctx.beginPath();
            ctx.moveTo(0, y);
            ctx.lineTo(canvasWidth, y);
            ctx.stroke();

            // Draw the number for the horizontal grid line
            if (y < canvasHeight && y >= 0) {
                ctx.fillText(i + 1, 5, y + 15 * zoomLevel); // Numbers from 1 to 10
            }
        }
    }

    // Function to draw trees
    function drawTrees(trees) {
        // Adjust tree size based on zoom level
        const treeRadius = 5 * zoomLevel;

        // Draw trees with status "Keep"
        trees.forEach(tree => {
            if (tree.status_tree === "Keep") {
                ctx.fillStyle = 'green';
                ctx.beginPath();
                ctx.arc((tree.x * zoomLevel) - scrollOffsetX, (tree.y * zoomLevel) - scrollOffsetY, treeRadius, 0, Math.PI * 2);
                ctx.fill();
            }
        });

        // Draw trees with status "Cut"
        trees.forEach(tree => {
            if (tree.status_tree === "Cut") {
                ctx.globalAlpha = 1;
                ctx.fillStyle = 'red';
                ctx.beginPath();
                ctx.arc((tree.x * zoomLevel) - scrollOffsetX, (tree.y * zoomLevel) - scrollOffsetY, treeRadius, 0, Math.PI * 2);
                ctx.fill();
            }
        });

// Draw trees with Damage_crown > 0 and status not "Cut"
    trees.forEach(tree => {
        if (tree.Damage_crown > 0 && tree.status_tree !== "Cut") {
            ctx.globalAlpha = 1;
            ctx.fillStyle = 'yellow';
            ctx.beginPath();
            ctx.arc((tree.x * zoomLevel) - scrollOffsetX, (tree.y * zoomLevel) - scrollOffsetY, treeRadius, 0, Math.PI * 2);
            ctx.fill();
        }
    });

        // Draw trees with Damage_crown > 0 and status not "Cut"
    trees.forEach(tree => {
        if (tree.Damage_stem > 0 && tree.status_tree !== "Cut") {
            ctx.globalAlpha = 1;
            ctx.fillStyle = 'yellow';
            ctx.beginPath();
            ctx.arc((tree.x * zoomLevel) - scrollOffsetX, (tree.y * zoomLevel) - scrollOffsetY, treeRadius, 0, Math.PI * 2);
            ctx.fill();
        }
    });

        canvas.addEventListener('mousemove', function(event) {
            const rect = canvas.getBoundingClientRect();
            const mouseX = event.clientX - rect.left + scrollOffsetX;
            const mouseY = event.clientY - rect.top + scrollOffsetY;

            let foundTree = false;
            for (const tree of trees) {
                const distance = Math.sqrt((mouseX - tree.x * zoomLevel) ** 2 + (mouseY - tree.y * zoomLevel) ** 2);
                if (distance < 5 * zoomLevel) {
                    tooltip.style.left = `${event.pageX + 10}px`;
                    tooltip.style.top = `${event.pageY + 10}px`;
                    tooltip.style.visibility = 'visible';
                    tooltip.innerText = `Coordinates: (${tree.x}, ${tree.y})`;
                    foundTree = true;
                    break;
                }
            }

            if (!foundTree) {
                tooltip.style.visibility = 'hidden';
            }
        });
    }

    // Function to zoom in
    function zoomIn() {
        zoomLevel *= zoomFactor;
        redraw();
    }

    // Function to zoom out
    function zoomOut() {
        const newZoomLevel = zoomLevel / zoomFactor;
        if (newZoomLevel >= minZoomLevel) {
            zoomLevel = newZoomLevel;
            redraw();
        }
    }

    // Function to redraw the canvas
    async function redraw() {
        drawGrid(); // Draw the grid first
        const forestData = await fetchForestData();
        drawTrees(forestData);
    }

    // Function to handle mouse down event
    function handleMouseDown(event) {
        if (event.button === 0) { // Left mouse button
            isDragging = true;
            initialMouseX = event.clientX;
            initialMouseY = event.clientY;
            document.addEventListener('mousemove', handleMouseMove);
            document.addEventListener('mouseup', handleMouseUp);
        }
    }

    // Function to handle mouse move event
    function handleMouseMove(event) {
        if (isDragging) {
            const deltaX = (event.clientX - initialMouseX) / zoomLevel;
            const deltaY = (event.clientY - initialMouseY) / zoomLevel;
            scrollOffsetX -= deltaX;
            scrollOffsetY -= deltaY;
            initialMouseX = event.clientX;
            initialMouseY = event.clientY;
            redraw();
        }
    }

    // Function to handle mouse up event
    function handleMouseUp(event) {
        if (event.button === 0) { // Left mouse button
            isDragging = false;
            document.removeEventListener('mousemove', handleMouseMove);
            document.removeEventListener('mouseup', handleMouseUp);
        }
    }

    // Function to handle keyboard arrow key events
    function handleKeyDown(event) {
        const arrowKeys = ["ArrowUp", "ArrowDown", "ArrowLeft", "ArrowRight"];
        if (arrowKeys.includes(event.key)) {
            event.preventDefault(); // Prevent default scrolling behavior
            moveCanvas(event.key);
        }
    }

    // Function to move the canvas based on keyboard arrow key
    function moveCanvas(key) {
        const step = 10; // Number of pixels to move on each arrow key press
        const adjustedStep = step / zoomLevel; // Adjust the step based on zoom level
        switch (key) {
            case "ArrowUp":
                scrollOffsetY -= adjustedStep;
                break;
            case "ArrowDown":
                scrollOffsetY += adjustedStep;
                break;
            case "ArrowLeft":
                scrollOffsetX -= adjustedStep;
                break;
            case "ArrowRight":
                scrollOffsetX += adjustedStep;
                break;
        }
        redraw();
    }

    // Initialize forest simulation
    async function init() {
        drawGrid(); // Draw the grid first
        const forestData = await fetchForestData();
        drawTrees(forestData);
    }

    zoomInBtn.addEventListener('click', zoomIn);
    zoomOutBtn.addEventListener('click', zoomOut);
    document.addEventListener('keydown', handleKeyDown);

    canvas.addEventListener('mousedown', handleMouseDown);

    init();
});
