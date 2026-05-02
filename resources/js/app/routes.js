export default [
  { route: "dashboard.index", label: "Dashboard" },
  { route: "user.index", label: "User" },
  { route: "team.index", label: "Team" },
  { route: "project.index", label: "Project" },
  {
    label: "Setting", sub: [
      // { route: "setting.private", label: "Private" },
      { route: "setting.general", label: "General" }
    ]
  },
];
