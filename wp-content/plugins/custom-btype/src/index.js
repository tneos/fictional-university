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
        <input
          type="text"
          placeholder="sky colour"
          value={props.attributes.skyColor}
          onChange={updateSkyColor}
        />
        <input
          type="text"
          placeholder="grass colour"
          value={props.attributes.grassColor}
          onChange={updateGrassColor}
        />
      </div>
    );
  },
  save: () => {
    return null;
  },
});
