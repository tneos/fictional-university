wp.blocks.registerBlockType("plugins/custom-btype", {
  title: "Custom block type",
  icon: "smiley",
  category: "common",
  edit: function () {
    return (
      <div>
        <h4>First Paragraph</h4>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi reiciendis magni
          perferendis dolor in recusandae accusantium repudiandae consequatur possimus quia sint
          vitae incidunt quaerat amet ex praesentium, ut aliquam doloribus.
        </p>
      </div>
    );
  },
  save: () => {
    return (
      <>
        <h3>Front end title</h3>
        <h5>This is the front-end!!</h5>
      </>
    );
  },
});
