wp.blocks.registerBlockType("plugins/custom-btype", {
  title: "Custom block type",
  icon: "smiley",
  category: "common",
  attributes: {
    skyColor: {type: "string"},
    grassColor: {type: "string"},
  },
  edit: props => {
    const updateSkyColor = event => {
      props.setAttributes({skyColor: event.target.value});
    };
    const updateGrassColor = event => {
      props.setAttributes({grassColor: event.target.value});
    };
    return (
      <div>
        <input type="text" placeholder="sky colour" onChange={updateSkyColor} />
        <input type="text" placeholder="grass colour" onChange={updateGrassColor} />
      </div>
    );
  },
  save: props => {
    return (
      <>
        <h3>
          Today the sky is {props.attributes.skyColor} and the grass is{" "}
          {props.attributes.grassColor}
        </h3>
      </>
    );
  },
});
