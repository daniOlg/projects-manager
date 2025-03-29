import {Project} from "@/pages/projects/types";

type ShowProps = {
    project: Project;
}

function Show({ project }: ShowProps) {
  return (
    <div className="container mx-auto p-5">
      <h1 className="text-2xl font-bold mb-4">{project.name}</h1>
      <p className="mb-2">Start Date: {project.start_date}</p>
      <p className="mb-2">Status: {project.status}</p>
      <p className="mb-2">Responsible: {project.responsible}</p>
      <p className="mb-2">Amount: {project.amount}</p>
    </div>
  );
}

export default Show;
