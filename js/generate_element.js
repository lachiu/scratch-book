function generate_element(tag, attributes = {}, children = []) {
    const element = document.createElement(tag);

    for (const [name, value] of Object.entries(attributes)) {
        if (value === undefined || value === null || value === false) {
            continue;
        }

        if (name.startsWith("on") && typeof value === "function") {
            element.addEventListener(name.slice(2).toLowerCase(), value);
        } else if ((name === "style" || name === "dataset") && typeof value === "object") {
            Object.assign(element[name], value);
        } else if (name in element) {
            element[name] = value;
        } else {
            element.setAttribute(name, value === true ? "" : value);
        }
    }

    element.append(...[].concat(children).filter((child) => child !== undefined && child !== null));

    return element;
}
